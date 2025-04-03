@extends('template')

@section('title','categorias')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('content')

@include('layouts.partials.alert')

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Categorías</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Categorías</li>
    </ol>

    
    <div class="mb-4">
        <a href="{{ route('categorias.create') }}">
            <button type="button" class="btn btn-primary">Añadir Categorias	</button>
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla Categorias
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="tabel table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                    <tr>
                        <td>
                            {{$categoria->caracteristica->nombre}}
                        </td>
                        <td>
                            {{$categoria->caracteristica->descripcion}}
                        </td>
                        <td>
                            @if ($categoria->caracteristica->estado == 1)
                            <span class="badge rounded-pill text-bg-success">activo</span>
                            @else
                            <span class="badge rounded-pill text-bg-danger">eliminado</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{route('categorias.edit',['categoria'=>$categoria])}}" method="get">
                                <button type="submit" class="btn btn-warning">Editar</button>
                            </form>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-danger">Eliminar</button>
                              </div>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>





@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush