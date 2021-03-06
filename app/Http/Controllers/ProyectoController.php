<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Tipo_Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos = DB::table('proyectos')
            ->join('tipo_proyecto', 'tipo_proyecto.id', '=', 'proyectos.proyecto_id')
            ->join('estatus', 'estatus.id', '=', 'proyectos.estatus_id')
            ->select('proyectos.*', 'tipo_proyecto.nombre AS tipo_proyecto', 'estatus.nombre AS estado')
            ->paginate(5);

        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoProyectos = Tipo_Proyecto::where('status', true)->orderBy('nombre', 'ASC')->get();

        //dd($tipoProyectos);

        /* return view('proyectos.create')->with('tipoProyectos', $tipoProyectos); */

        return view('proyectos.create', compact('tipoProyectos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $temp = $request->validate([
            'nombre' => 'required|string|min:5',
            'tipo_proyecto' => 'required|integer|exists:App\Models\Tipo_Proyecto,id',
            'descripcion' => 'required|string'
        ]);

        DB::table('proyectos')->insert([
            'nombre' => $temp['nombre'],
            'descripcion' => $temp['descripcion'],
            'proyecto_id' => $temp['tipo_proyecto'],
            'estatus_id' => 1, //Pendiente
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('proyectos.index')->with('status', 'Se registró correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Proyecto $proyecto)
    {
        $tipoProyectos = Tipo_Proyecto::where('status', true)->orderBy('nombre', 'ASC')->get();
        return view('proyectos.edit', compact('tipoProyectos', 'proyecto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $data = $request->validate([
            'nombre' => 'required|string|min:5',
            'tipo_proyecto' => 'required|integer|exists:App\Models\Tipo_Proyecto,id',
            'descripcion' => 'required|string'
        ]);
        $proyecto->nombre = $data['nombre'];
        $proyecto->descripcion = $data['descripcion'];
        $proyecto->proyecto_id = $data['tipo_proyecto'];
        $proyecto->save();
        return redirect()->route('proyectos.index')->with('status', 'Se actualizó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proyecto = Proyecto::where('id', $id)->delete();

        return redirect()->route('proyectos.index')->with('status', 'Se eliminó correctamente');
    }

    public function search(Request $request)
    {
        $busqueda = $request->input('q');
        $busqueda = trim($busqueda);

        $proyectos = Proyecto::select('proyectos.*')
            ->join('tipo_proyecto', 'tipo_proyecto.id', '=', 'proyectos.proyecto_id')
            ->join('estatus', 'estatus.id', '=', 'proyectos.estatus_id')
            ->where(function ($q) use ($busqueda) {
                $q->Where('estatus.nombre', 'LIKE', "%$busqueda%")
                    ->orWhere('proyectos.nombre', 'LIKE', "%$busqueda%")
                    ->orWhere('tipo_proyecto.nombre', 'LIKE', "%$busqueda%")
                    ->orWhere('estatus.nombre', 'LIKE', "%$busqueda%");
            })
            ->with('estatus', 'tipoProyecto')
            ->paginate(env('APP_PAGINATE'));
        return view('proyectos.index', compact('proyectos'));
    }
}
