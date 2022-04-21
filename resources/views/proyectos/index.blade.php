@extends('layouts.app')
@section('title', 'Crear un nuevo proyecto')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Proyectos</h1>
    </div>
    <div class="col-md-6">
        <a class="btn btn-success" href="{{ route('proyectos.create') }}">Nuevo proyecto</a>
    </div>
    <div class="col-md-6">
        <form class="d-flex flex-row" method="get" action="{{route('proyecto.search')}}">
            <input type="text" class="form-control" name="q" id="q" required>
            <button type="submit" class="btn btn-success">Buscar</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mt-4">
        <h1>Lista de proyectos</h1>
    </div>
    <div class="col-md-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <!-- <th scope="col">Slug</th> -->
                    <th scope="col">Tipo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proyectos as $proyecto)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$proyecto->nombre}}</td>
                    <td>{{$proyecto->descripcion}}</td>
                    <td>{{$proyecto->tipo_proyecto}}</td>
                    <td>{{$proyecto->estado}}</td>
                    <td><a href="{{route('proyectos.edit', $proyecto->id)}}">
                            <button type="button" class="btn btn-danger">Editar</button></a></td>
                    <td><a href="{{route('proyectos.destroy', $proyecto->id)}}">
                            <button type="button" class="btn btn-danger">Eliminar</button></a></td>
                </tr>
                @endforeach

            </tbody>
        </table>
        {{ $proyectos->links() }}
    </div>
</div>
@endsection