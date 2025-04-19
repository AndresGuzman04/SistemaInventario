@extends('template')

@section('title','productos')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('content')

@include('layouts.partials.alert')

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Productos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Productos</li>
    </ol>

    
    <div class="mb-4">
        <a href="{{ route('productos.create') }}">
            <button type="button" class="btn btn-primary">Añadir Producto	</button>
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla Productos
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="tabel table-striped">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Presentación</th>
                        <th>Categorías</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $item)
                    <tr>
                        <td>
                            {{$item->codigo}}
                        </td>
                        <td>
                            {{$item->nombre}}
                        </td>
                        <td>
                            {{$item->marca->caracteristica->nombre}}
                        </td>
                        <td>
                            {{$item->presentacione->caracteristica->nombre}}
                        </td>
                        <td>
                            @foreach ($item->categorias as $category)
                            <div class="container" style="font-size: small;">
                                <div class="row">
                                    <span class="m-1 rounded-pill p-1 bg-secondary text-white text-center">{{$category->caracteristica->nombre}}</span>
                                </div>
                            </div>
                            @endforeach
                        </td>
                        <td>
                            <div class="container" style="font-size: small;">
                                @if ($item->estado == 1)
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
                            <!-- Menú desplegable de acciones -->
                            <div class="dropdown">
                                <button style="height: 35px;" class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="accionesDropdown-{{ $item->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="accionesDropdown-{{ $item->id }}">
                                    <!-- Botón de Editar -->
                                    <li>
                                        <form action="{{ route('productos.edit', ['producto' => $item]) }}" method="get" class="d-inline">
                                            <button style="width: 100%; height: 35px;" type="submit" class="btn btn-warning btn-sm w-full">
                                                <i class="fas fa-edit me-2"></i> Editar
                                            </button>
                                        </form>
                                    </li>
                                    
                                    <!-- Botón de Ver -->
                                    <li>
                                        <button style="width: 100%; height: 35px;" type="button" class="btn btn-info btn-sm w-full" data-bs-toggle="modal" data-bs-target="#verModal-{{ $item->id }}">
                                            <i class="fas fa-eye me-2"></i> Ver
                                        </button>
                                        
                                    </li>
                                    
                                    <!-- Botón de Eliminar o Restaurar -->
                                    <li>
                                        @if ($item->estado == 1)
                                            <button style="width: 100%; height: 35px;" type="button" class="btn btn-danger btn-sm w-full" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $item->id }}">
                                                <i class="fas fa-trash me-2"></i> Eliminar
                                            </button>
                                        @else
                                            <button style="width: 100%; height: 35px;" type="button" class="btn btn-danger btn-sm w-full" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $item->id }}">
                                                <i class="fas fa-undo me-2"></i> Restaurar
                                            </button>
                                        @endif
                                        
                                    </li>
                                </ul>
                            </div>

                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="verModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles del producto</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p><span class="fw-bolder">Descripción: </span>{{$item->descripcion}}</p>
                                        </div>
                                        <div class="col-12">
                                            <p><span class="fw-bolder">Fecha de vencimiento: </span>{{$item->fecha_vencimiento=='' ? 'No tiene' : $item->fecha_vencimiento}}</p>
                                        </div>
                                        <div class="col-12">
                                            <p><span class="fw-bolder">Stock: </span>{{$item->stock}}</p>
                                        </div>
                                        <div class="col-12">
                                            <p class="fw-bolder">Imagen:</p>
                                            <div>
                                                @if ($item->img_path != null)
                                                <img src="{{ asset('img/productos/'.$item->img_path) }}" alt="{{$item->nombre}}" class="img-fluid img-thumbnail border-4 rounded">
                                                @else
                                                <img src="" alt="{{$item->nombre}}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal de confirmación-->
                    <div class="modal fade" id="confirmModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $item->estado == 1 ? '¿Seguro que quieres eliminar el producto?' : '¿Seguro que quieres restaurar el producto?' }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{ route('productos.destroy',['producto'=>$item->id]) }}" method="post">
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