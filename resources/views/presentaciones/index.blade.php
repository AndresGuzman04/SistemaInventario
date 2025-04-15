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
    <h1 class="mt-4 text-center">Presentaciones</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Presentaciones</li>
    </ol>

    
    <div class="mb-4">
        <a href="{{ route('presentaciones.create') }}">
            <button type="button" class="btn btn-primary">Añadir Presentación	</button>
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla Presentaciones
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
                    @foreach ($presentaciones as $presentacione)
                    <tr>
                        <td>
                            {{$presentacione->caracteristica->nombre}}
                        </td>
                        <td>
                            {{$presentacione->caracteristica->descripcion}}
                        </td>
                        <td>
                            @if ($presentacione->caracteristica->estado == 1)
                                <span style="width: 75%;"  class="badge bg-success text-white px-3 py-2 rounded-pill">Activo</span>
                            @else
                                <span style="width: 75%;" class="badge bg-danger text-white px-3 py-2 rounded-pill">Eliminado</span>
                            @endif
                        </td>
                        <td>
                            <!-- Botón de Editar -->
                            <form action="{{ route('presentaciones.edit', ['presentacione' => $presentacione]) }}" method="get" class="d-inline">
                                <button style="width: 40%; height: 35px;" type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit" style="font-size: 18px;"></i> <!-- Icono de edición -->
                                </button>
                            </form>
                        
                            <!-- Botón de Eliminar o Restaurar -->
                            @if ($presentacione->caracteristica->estado == 1)
                                <button style="width: 40%; height: 35px;" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$presentacione->id}}">
                                    <i class="fas fa-trash" style="font-size: 18px;"></i> <!-- Icono de papelera -->
                                </button>
                            @else
                                <button style="width: 40%; height: 35px;" type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$presentacione->id}}">
                                    <i class="fas fa-undo" style="font-size: 18px;"></i> <!-- Icono de restaurar -->
                                </button>
                            @endif
                        </td>
                        
                        </tr>
                        <!-- Modal -->
                    <div class="modal fade" id="confirmModal-{{$presentacione->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $presentacione->caracteristica->estado == 1 ? '¿Seguro que quieres eliminar la presentación?' : '¿Seguro que quieres restaurar la presentación?' }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{ route('presentaciones.destroy',['presentacione'=>$presentacione->id]) }}" method="post">
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