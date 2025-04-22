


<div class="card text-bg-light">
    <form action="{{ route('categorias.store') }}" method="post">
        @csrf
        <div class="card-body">
            <div class="row g-4">

                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre')}}">
                    @error('nombre')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" rows="3" class="form-control">{{old('descripcion')}}</textarea>
                    @error('descripcion')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
            </div>

        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>

