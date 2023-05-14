@extends('layouts.app')

@section('title', 'Editar Proyecto')

@section('content')

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Editar Proyecto</h1>
    <a href="{{ route('proyectos') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-arrow-left fa-sm text-white-50"></i>
      Regresar
    </a>
  </div>

  {{-- Alert Messages --}}
  @include('common.alert')

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Editar Clientes</h6>
    </div>
      <form method="POST" action="{{ route('proyectos.update', $proyecto->id) }}">
      @csrf
      @method('PUT')

      <div class="card-body">
        <div class="form-group row">

          {{-- Estado --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <span style="color:red;">*</span>Estado</label>
            <select class="form-control form-control-proyecto @error('status') is-invalid @enderror" 
                    name="status" id="status" 
                    placeholder="Estado actual de proyecto" 
                    value="{{ old('status') ? old('status') : $proyecto->status }}">
              <option value="1">Activo</option>
              <option value="2">Pendiente</option>
              <option value="2">Realizado</option>
            </select>
            @error('status')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          {{-- Nombre --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <span style="color:red;">*</span>Nombre</label>
            <input type="text" class="form-control form-control-proyecto @error('nombre') is-invalid @enderror" 
                   placeholder="Nombre de proyecto" 
                   name="nombre" id="nombre" 
                   value="{{ old('nombre') ? old('nombre') : $proyecto->nombre }}">
            @error('nombre')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          {{-- cliente_id --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <label for="cliente_id"><span style="color:red;">*</span>Clientes</label>
            <select class="form-control form-control-proyecto @error('cliente_id') is-invalid @enderror" name="cliente_id" id="cliente_id">
              <option value="">Seleccionar cliente</option>
                @foreach ($todos_los_clientes as $cliente)
                  <option value="{{ $cliente->id }}" {{ $cliente->id == $proyecto->cliente_id ? 'selected' : '' }}>
                  {{ $cliente->Nombre }}
                  </option>
                @endforeach
            </select>
            @error('cliente_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>


          {{-- Direccion --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <span style="color:red;">*</span>Direccion</label>
            <input type="text" class="form-control form-control-proyecto @error('direccion') is-invalid @enderror" 
                   placeholder="Direccion" name="direccion"
                   value="{{ old('direccion') ? old('direccion') : $proyecto->direccion }}">
            @error('direccion')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          {{-- Ubicación --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <span style="color:red;">*</span>Ubicación</label>
            <input type="text" class="form-control form-control-proyecto @error('ubicacion') is-invalid @enderror" 
            placeholder="Agregar una ubicacion" 
            name="ubicacion" id="ubicacion" 
            value="{{ old('ubicacion') ? old('ubicacion') : $proyecto->ubicacion }}">
            @error('ubicacion')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          {{-- Fecha_inicio --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <span style="color:red;">*</span>Fecha de inicio</label>
            <input type="date" class="form-control form-control-proyecto @error('Fecha_inicio') is-invalid @enderror" 
                   placeholder="Ingresar fecha inicio" name="fecha_inicio" id="fecha_inicio" 
                   value="{{ old('fecha_inicio') ? old('fecha_inicio') : $proyecto->fecha_inicio }}">
            @error('Fecha_inicio')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          {{-- Fecha_fin --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <span style="color:red;">*</span>Fecha de culminacion</label>
            <input type="date" class="form-control form-control-proyecto @error('Fecha_fin') is-invalid @enderror" 
                   placeholder="Ingresar fecha final" name="fecha_fin" id="fecha_fin" 
                   value="{{ old('fecha_fin') ? old('fecha_fin') : $proyecto->fecha_fin }}">
            @error('Fecha_fin')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          {{-- Nombre_contacto --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <span style="color:red;">*</span>Nombre Contacto</label>
            <input type="text" class="form-control form-control-proyecto @error('nombre_contacto') is-invalid @enderror" 
                   placeholder="Nombre de Contacto" name="nombre_contacto" id="nombre_contacto" 
                   value="{{ old('nombre_contacto') ? old('nombre_contacto') : $proyecto->nombre_contacto }}">
            @error('nombre_contacto')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          {{-- Telefono_contacto --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <span style="color:red;">*</span>Telefono Contacto</label>
            <input type="text" class="form-control form-control-proyecto @error('telefono_contacto') is-invalid @enderror" 
                   placeholder="Numero de Telefono" name="telefono_contacto" id="telefono_contacto" 
                   value="{{ old('telefono_contacto') ? old('telefono_contacto') : $proyecto->telefono_contacto }}">
            @error('telefono_contacto')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-success btn-proyecto float-right mb-3">Update</button>
        <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('proyectos') }}">Cancelar</a>
      </div>
    </form>
  </div>
</div>

@endsection