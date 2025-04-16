@extends('template')

@section('title','marcas')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('content')

@include('layouts.partials.alert')

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Marcas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Marcas</li>
    </ol>

    
    <div class="mb-4">
        <a href="{{ route('marcas.create') }}">
            <button type="button" class="btn btn-primary">Añadir Marca	</button>
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla Marcas
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
                    @foreach ($marcas as $marca)
                    <tr>
                        <td>
                            {{$marca->caracteristica->nombre}}
                        </td>
                        <td>
                            {{$marca->caracteristica->descripcion}}
                        </td>
                        <td>
                            <div class="container" style="font-size: small;">
                                @if ($marca->caracteristica->estado == 1)
                                <div class="row">
                                    <span  class="m-1 rounded-pill p-1 bg-success text-white text-center">Activo</span>
                                </div>
                                @else
                                <div class="row">
                                    <span  class="m-1 rounded-pill p-1 bg-danger text-white text-center">Eliminado</span>
                                </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <!-- Botón de Editar -->
                            <form action="{{ route('marcas.edit', ['marca' => $marca]) }}" method="get" class="d-inline">
                                <button style="width: 40%; height: 35px;" type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit" style="font-size: 18px;"></i> <!-- Icono de edición -->
                                </button>
                            </form>
                        
                            <!-- Botón de Eliminar o Restaurar -->
                            @if ($marca->caracteristica->estado == 1)
                                <button style="width: 40%; height: 35px;" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$marca->id}}">
                                    <i class="fas fa-trash" style="font-size: 18px;"></i> <!-- Icono de papelera -->
                                </button>
                            @else
                                <button style="width: 40%; height: 35px;" type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$marca->id}}">
                                    <i class="fas fa-undo" style="font-size: 18px;"></i> <!-- Icono de restaurar -->
                                </button>
                            @endif
                        </td>
                        
                        </tr>
                        <!-- Modal -->
                    <div class="modal fade" id="confirmModal-{{$marca->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $marca->caracteristica->estado == 1 ? '¿Seguro que quieres eliminar la Marca?' : '¿Seguro que quieres restaurar la Marca?' }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{ route('marcas.destroy',['marca'=>$marca->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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