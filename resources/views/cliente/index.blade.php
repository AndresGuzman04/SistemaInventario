@extends('template')

@section('title','clientes')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('content')

@include('layouts.partials.alert')

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Clientes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Clientes</li>
    </ol>

    <div class="mb-4">
        <a href="{{route('clientes.create')}}">
            <button type="button" class="btn btn-primary">Añadir Cliente</button>
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla clientes
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped fs-6">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Documento</th>
                        <th>Contactos</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $item)
                    <tr>
                        <td>
                            {{$item->persona->razon_social}}
                        </td>
                        <td>
                            {{$item->persona->direccion}}
                        </td>
                        <td>
                            <p class="fw-semibold mb-1">{{$item->persona->documento->tipo_documento}}</p>
                            <p class="text-muted mb-0">{{$item->persona->numero_documento}}</p>
                        </td>
                        <td>
                            <p class="text-muted mb-0">{{$item->persona->telefono}}</p>
                            <p class="text-muted mb-0">{{$item->persona->correo}}</p>
                        </td>
                        <td>
                            {{$item->persona->tipo_persona}}
                        </td>
                        <td>
                            <div class="container" style="font-size: small;">
                                @if ($item->persona->estado == 1)
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
                            <form action="{{ route('clientes.edit', ['cliente' => $item]) }}" method="get" class="d-inline">
                                <button style="width: 40%; height: 35px;" type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit" style="font-size: 18px;"></i> <!-- Icono de edición -->
                                </button>
                            </form>
                        
                            <!-- Botón de Eliminar o Restaurar -->
                            @if ($item->persona->estado == 1)
                                <button style="width: 40%; height: 35px;" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}">
                                    <i class="fas fa-trash" style="font-size: 18px;"></i> <!-- Icono de papelera -->
                                </button>
                            @else
                                <button style="width: 40%; height: 35px;" type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}">
                                    <i class="fas fa-undo" style="font-size: 18px;"></i> <!-- Icono de restaurar -->
                                </button>
                            @endif
                        </td>
                    </tr>

                    <!-- Modal de confirmación-->
                    <div class="modal fade" id="confirmModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $item->persona->estado == 1 ? '¿Seguro que quieres eliminar el cliente?' : '¿Seguro que quieres restaurar el cliente?' }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{ route('clientes.destroy',['cliente'=>$item->persona->id]) }}" method="post">
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