@extends('layouts.app')

@section('title', 'Proyecto')

@section('content')

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Proyecto</h1>
    <a href="{{ route('proyectos') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-arrow-left fa-sm text-white-50"></i>
      Regresar
    </a>
  </div>

  {{-- Alert Messages --}}
  @include('common.alert')

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Proyecto</h6>
    </div>

      <div class="card-body">
        <div class="form-group row">

          {{-- Estado --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            Estado</label>
            <input class="form-control form-control-proyecto @error('status') is-invalid @enderror" 
                    name="status" id="status" 
                    placeholder="Estado actual de proyecto" 
                    value="{{ $proyecto->status }}" readonly>
          </div>

          {{-- Nombre --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            Nombre</label>
            <input type="text" class="form-control form-control-proyecto @error('nombre') is-invalid @enderror" 
                   placeholder="Nombre de proyecto" 
                   name="nombre" id="nombre" 
                   value="{{ $proyecto->nombre }}" readonly>
          </div>

          {{-- cliente_id --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <label for="cliente_id">Clientes</label>
            <input class="form-control form-control-proyecto @error('cliente_id') is-invalid @enderror" 
                   name="cliente_id" id="cliente_id" 
                   value="{{ $proyecto->cliente_id }}" readonly>
          </div>


          {{-- Direccion --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            Direccion</label>
            <input type="text" class="form-control form-control-proyecto @error('direccion') is-invalid @enderror" 
                   placeholder="Direccion" name="direccion"
                   value="{{ $proyecto->direccion }}" readonly>
          </div>

          {{-- Ubicación --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            Ubicación</label>
            <input type="text" class="form-control form-control-proyecto @error('ubicacion') is-invalid @enderror" 
            placeholder="Agregar una ubicacion" 
            name="ubicacion" id="ubicacion" 
            value="{{ $proyecto->ubicacion }}" readonly>
          </div>

          {{-- Fecha_inicio --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            Fecha de inicio</label>
            <input type="date" class="form-control form-control-proyecto @error('Fecha_inicio') is-invalid @enderror" 
                   placeholder="Ingresar fecha inicio" name="fecha_inicio" id="fecha_inicio" 
                   value="{{ $proyecto->fecha_inicio }}" readonly>
          </div>

          {{-- Fecha_fin --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            Fecha de culminacion</label>
            <input type="date" class="form-control form-control-proyecto @error('Fecha_fin') is-invalid @enderror" 
                   placeholder="Ingresar fecha final" name="fecha_fin" id="fecha_fin" 
                   value="{{ $proyecto->fecha_fin }}" readonly>
          </div>

          {{-- Nombre_contacto --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            Nombre Contacto</label>
            <input type="text" class="form-control form-control-proyecto @error('nombre_contacto') is-invalid @enderror" 
                   placeholder="Nombre de Contacto" name="nombre_contacto" id="nombre_contacto" 
                   value="{{ $proyecto->nombre_contacto }}" readonly>
          </div>

          {{-- Telefono_contacto --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            Telefono Contacto</label>
            <input type="text" class="form-control form-control-proyecto @error('telefono_contacto') is-invalid @enderror" 
                   placeholder="Numero de Telefono" name="telefono_contacto" id="telefono_contacto" 
                   value="{{ $proyecto->telefono_contacto }}" readonly>
          </div>

        </div>
      </div>
  </div>
</div>

@endsection