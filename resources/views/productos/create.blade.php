@extends('template')

@section('title','Crear categoría')

@push('css')
<style>
    #descripcion {
        resize: none;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush

@section('content')
@include('layouts.partials.alert')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Producto</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('productos.index')}}">Productos</a></li>
        <li class="breadcrumb-item active">Crear producto</li>
    </ol>

    <div class="card">
        <form id="form-producto" action="{{ route('productos.store') }}" id="form-products" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body text-bg-light">

                <div class="row g-4">

                    <!----Codigo---->
                    <div class="col-md-6">
                        <label for="codigo" class="form-label">Código:</label>
                        <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo', $datosTemporales['codigo'] ?? '') }}">
                        @error('codigo')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Nombre---->
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre', $datosTemporales['nombre'] ?? '')}}">
                        @error('nombre')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Descripción---->
                    <div class="col-md-6">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" rows="1" class="form-control">{{old('descripcion', $datosTemporales['descripcion'] ?? '')}}</textarea>
                        @error('descripcion')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Fecha de vencimiento---->
                    <div class="col-md-6">
                        <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento:</label>
                        <div class="input-group">
                            <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" value="{{old('fecha_vencimiento')}}">
                            <button type="button" class="btn btn-outline-secondary" onclick="limpiarFecha()">🧹</button>
                        </div>
                        @error('fecha_vencimiento')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Imagen---->
                    <div class="col-md-6">
                        <label for="img_path" class="form-label">Imagen:</label>
                        <div class="input-group">
                            <input type="file" name="img_path" id="img_path" class="form-control" accept="image/*">
                            <button type="button" class="btn btn-outline-secondary" onclick="limpiarImagen()">🧹</button>
                        </div>
                        @error('img_path')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Categorías---->
                    <div class="col-md-6">
                        <label for="categorias" class="form-label">Categorías:</label>
                        <div class="input-group">
                            <select data-size="4"  title="Seleccione las categorías" data-live-search="true" name="categorias[]" id="categorias" class="form-control selectpicker show-tick" multiple>
                                @foreach ($categorias as $item)
                                <option value="{{$item->id}}" {{ (in_array($item->id , old('categorias',[] ))) ? 'selected' : '' }}>{{$item->nombre}}</option>
                                @endforeach
                            </select>
                            <a  href="{{ route('categorias.create', ['redirect' => 'productos.create']) }}">
                                <button type="button" class="btn btn-outline-primary" >
                                    <i class="fas fa-plus"></i> 
                                </button>
                            </a>
                        </div>
                        @error('categorias')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Marca---->
                    <div class="col-md-6">
                        <label for="marca_id" class="form-label">Marca:</label>
                        <div class="input-group">
                            <select data-size="4" title="Seleccione una marca" data-live-search="true" name="marca_id" id="marca_id" class="form-control selectpicker show-tick">
                                
                                @foreach ($marcas as $item)
                                <option value="{{$item->id}}" {{ old('marca_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                                @endforeach
                            </select>
                            <a  href="{{ route('marcas.create', ['redirect' => 'productos.create']) }}">
                                <button type="button" class="btn btn-outline-primary" >
                                    <i class="fas fa-plus"></i> 
                                </button>
                            </a>
                        </div> <!-- Closing div for input-group -->
                        @error('marca_id')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Presentaciones---->
                    <div class="col-md-6">
                        <label for="presentacione_id" class="form-label">Presentación:</label>
                        <div class="input-group">
                            <select data-size="4" title="Seleccione una presentación" data-live-search="true" name="presentacione_id" id="presentacione_id" class="form-control selectpicker show-tick">
                                @foreach ($presentaciones as $item)
                                    <option value="{{ $item->id }}" {{ old('presentacione_id') == $item->id ? 'selected' : '' }}>{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                            <a  href="{{ route('presentaciones.create', ['redirect' => 'productos.create']) }}">
                                <button type="button" class="btn btn-outline-primary" >
                                    <i class="fas fa-plus"></i> 
                                </button>
                            </a>
                        </div>
                        @error('presentacione_id')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="card-footer text-center">
                <button id="guardar-button" type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>

    </div>

</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<script>
    const formulario = document.getElementById('form-producto');

    function guardarTemporal() {
        const form = document.querySelector('#form-producto'); // Asegúrate que tenga ese ID
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        fetch('/productos/guardar-temporal', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Guardado temporal exitoso', data);
        })
        .catch(error => {
            console.error('Error al guardar temporalmente:', error);
        });
    }

    // Escucha cambios en los inputs
    formulario.querySelectorAll('input, select, textarea').forEach(input => {
        input.addEventListener('change', guardarTemporal);
    });

</script>

<script>
    function limpiarFecha() {
        document.getElementById('fecha_vencimiento').value = '';
    }

    function limpiarImagen() {
        document.getElementById('img_path').value = '';
    }
</script>

@endpush