<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        echo "Bienvenido";
    }

    public function conoceme()
    {
        echo "Hola";
    }

    public function show(Request $request)
    {

        echo "Bienvenido";

        $parametro = $request->usuario;
        echo "<br>Tu nombre es $parametro";
    }
}
