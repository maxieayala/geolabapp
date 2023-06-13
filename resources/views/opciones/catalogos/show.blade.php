@extends('layouts.app')

@section('title', 'Catalogo')

@section('content')

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Catalogo</h1>

      <i class="fas fa-arrow-left fa-sm text-white-50"></i>
      Regresar
    </a>
  </div>

  {{-- Alert Messages --}}
  @include('common.alert')

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Catalogo</h6>
    </div>

      <div class="card-body">
        <div class="form-group row">

          {{-- ID --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            ID</label>
            <input class="form-control form-control-catalogo @error('id') is-invalid @enderror" 
                    name="id" id="id" 
                    placeholder="ID de catalogo" 
                    value="{{ $catalogo->id }}" readonly>
          </div>

          {{-- Nombre --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            Nombre</label>
            <input type="text" class="form-control form-control-catalogo @error('nombre') is-invalid @enderror" 
                   placeholder="Nombre de catalogo" 
                   name="nombre" id="nombre" 
                   value="{{ $catalogo->nombre }}" readonly>
          </div>

          {{-- Descripcion --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <label for="descripcion">Descripcion</label>
            <input class="form-control form-control-catalogo @error('descripcion') is-invalid @enderror" 
                   name="descripcion" id="descripcion" 
                   value="{{ $catalogo->descripcion }}" readonly>
          </div>


          {{-- ID padre --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            ID Padre</label>
            <input type="text" class="form-control form-control-catalogo @error('id_padre') is-invalid @enderror" 
                   placeholder="ID Padre" name="id_padre"
                   value="{{ $catalogo->id_padre }}" readonly>
          </div>

        </div>
      </div>
  </div>
</div>

@endsection