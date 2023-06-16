@extends('layouts.app')

@section('title', 'Editar catalogo')

@section('content')

    <div class="container-fluid">

        <!-- Encabezado -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Editar</h1>
            <a href="{{ route('catalogos.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i>
            Regresar
            </a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Catalogo a editar</h6>
            </div>
            <form method="POST" action="{{ route('catalogos.update', ['id' => $catalogo->id]) }}">
                @csrf
                @method('POST')

                <div class="card-body">
                    <div class="form-group row">

                        {{-- Nombre --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Nombre</label>
                            <input type="text"
                                class="form-control form-control-catalogo @error('nombre') is-invalid @enderror"
                                id="exampleFirstName" placeholder="Primer Nombre" name="nombre"
                                value="{{ old('nombre') ? old('nombre') : $catalogo->nombre }}">

                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Descripcion --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Descripcion</label>
                            <input type="text"
                                class="form-control form-control-catalogo @error('descripcion') is-invalid @enderror"
                                id="exampleDescripcion" placeholder="descripcion" name="descripcion"
                                value="{{ old('descripcion') ? old('descripcion') : $catalogo->descripcion }}">

                            @error('descripcion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-catalogo float-right mb-3">Actualizar</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('catalogos.index') }}">Cancelar</a>
                </div>
            </form>
        </div>

    </div>


@endsection
