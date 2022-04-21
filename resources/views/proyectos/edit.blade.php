@extends('layouts.app')
@section('title', 'Editar un proyecto')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-3">Nuevo Proyecto</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route('proyectos.update',['proyecto'=>$proyecto->id]) }}">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-6">
                    <label form="nombre" class="text-secondary font-weigth-bold d-block @error('nombre') text-danger @enderror">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control border-0 shadow @error('nombre') is-invalid @enderror" placeholder="¿Cuál es el proyecto?" value="{{ old('nombre') ?? $proyecto->nombre }}" />
                    @error('nombre')
                    <span class="d-block text-danger mt-2 font-weight-bold">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label form="tipo_proyecto" class="text-secondary font-weigth-bold d-block">Tipo proyecto</label>
                    <select id="tipo_proyecto" name="tipo_proyecto" class="form-control border-0 shadow">
                        <option value="" selected disabled>Selecciona -</option>
                        @foreach($tipoProyectos as $tipoProyecto)
                        <option {{$tipoProyecto->id == $proyecto->estatus_id ? 'selected' : null }} value="{{ $tipoProyecto ->id }}">{{ $tipoProyecto->nombre }}</option>
                        @endforeach
                    </select>
                    @error('tipoProyecto')
                    <span class="d-block text-danger mt-2 font-weight-bold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 mt-3">
                    <label form="descripcion" class="text-secondary font-weigth-bold d-block @error('descripcion') text-danger @enderror">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="form-control border-0 shadow @error('descripcion') is-invalid @enderror" rows="5">{{ old('descripcion') ?? $proyecto->descripcion}}</textarea>
                    @error('descripcion')
                    <span class="d-block text-danger mt-2 font-weight-bold">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-5">Guardar proyecto</button>
        </form>
    </div>

</div>
</div>
@endsection