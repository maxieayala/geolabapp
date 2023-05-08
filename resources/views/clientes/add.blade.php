@extends('layouts.app')

@section('title', 'Agregar cliente')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Agregar cliente</h1>
            <a href="{{ route('clientes') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-arrow-left fa-sm text-white-50"></i> Regresar</a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Agregar nuevo</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('cliente_guardar') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">

                        {{-- Name --}}
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <span style="color:red;">*</span>Nombre</label>
                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror"
                                id="nombre" placeholder="Nombre" name="nombre" value="{{ old('nombre') }}">

                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        {{-- Email --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Email</label>
                            <input type="email"
                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                id="email" placeholder="Email" name="email" value="{{ old('email') }}">

                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Mobile Number --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Telefono</label>
                            <input type="tel"
                                class="form-control form-control-user @error('telefono') is-invalid @enderror"
                                id="telefono" placeholder="Numero de Telefono" name="telefono"
                                value="{{ old('telefono') }}">

                            @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- tipo --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Tipo</label>
                            <select class="form-control form-control-user @error('cliente_id') is-invalid @enderror"
                                name="cliente_id" id='cliente_id'>
                                <option selected disabled>Seleccionar</option>
                                @foreach ($tipo_clientes as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                            @error('tipo_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0 " style="display:none;">
                            <span style="color:red;">*</span>RUC</label>
                            <input type="text" class="form-control form-control-user @error('ruc') is-invalid @enderror"
                                id="ruc" placeholder="ruc" name="ruc" value="{{ old('ruc') }}">

                            @error('ruc')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Status</label>
                            <select class="form-control form-control-user @error('status') is-invalid @enderror"
                                name="status">
                                <option selected disabled>Seleccionar estado</option>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <span style="color:red;">*</span>direccion</label>
                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror"
                                id="exampleName" placeholder="direccion" name="direccion" value="{{ old('direccion') }}">

                            @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-user float-right mb-3">Save</button>
                        <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('clientes') }}">Cancel</a>
                    </div>
                </div>
                </form>

        </div>

    </div>


@endsection

@section('scripts')
<script>
    var select = document.getElementById("my-cliente_id");
    select.onchange = function() {
      var div = document.getElementById("ruc");
      if (select.value == "2") {
        div.style.display = "block";
      } else {
        div.style.display = "none";
      }
    }
  </script>
@endsection
