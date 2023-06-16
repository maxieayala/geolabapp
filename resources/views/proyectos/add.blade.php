@extends('layouts.app')

@section('title', 'Agregar Proyecto')

@section('content')

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Agregar Proyecto</h1>
    <a href="{{ route('proyectos') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-arrow-left fa-sm text-white-50"></i>
      Regresar
    </a>
  </div>

  {{-- Alert Messages --}}
  @include('common.alert')

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Agregar Nuevo</h6>
    </div>
    <form method="POST" action="{{ route('proyecto_guardar') }}">
      @csrf
      <div class="card-body">
        <div class="form-group row">

          {{-- Estado --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <span style="color:red;">*</span>Estado</label>
            <select class="form-control form-control-proyecto @error('status') is-invalid @enderror" name="status" id="status" placeholder="Estado actual de proyecto" value="{{ old('status') }}">
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
            <input type="text" class="form-control form-control-proyecto @error('nombre') is-invalid @enderror" placeholder="Nombre de proyecto" name="nombre" id="nombre" value="{{ old('nombre') }}">
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
              <option value="{{ $cliente->id }}">{{ $cliente->Nombre }}</option>
              @endforeach
            </select>
            @error('cliente_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          {{-- Direccion --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <span style="color:red;">*</span>Direccion</label>
            <input type="text" class="form-control form-control-proyecto @error('direccion') is-invalid @enderror" placeholder="Direccion" name="direccion" value="{{ old('direccion') }}">

            @error('direccion')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          {{-- Ubicación --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <span style="color:red;">*</span>Ubicación</label>
            <input type="text" class="form-control form-control-proyecto @error('ubicacion') is-invalid @enderror" placeholder="Agregar una ubicacion" name="ubicacion" id="ubicacion" value="{{ old('ubicacion') }}">
            @error('ubicacion')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          {{-- Fecha_inicio --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <span style="color:red;">*</span>Fecha de inicio</label>
            <input type="date" class="form-control form-control-proyecto @error('Fecha_inicio') is-invalid @enderror" placeholder="Ingresar fecha inicio" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio') }}">
            @error('fecha_inicio')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          {{-- Fecha_fin --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <span style="color:red;">*</span>Fecha de culminacion</label>
            <input type="date" class="form-control form-control-proyecto @error('Fecha_fin') is-invalid @enderror" placeholder="Ingresar fecha final" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin') }}">
            @error('fecha_fin')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          {{-- Nombre_contacto --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <span style="color:red;">*</span>Nombre Contacto</label>
            <input type="text" class="form-control form-control-proyecto @error('nombre_contacto') is-invalid @enderror" placeholder="Nombre de Contacto" name="nombre_contacto" id="nombre_contacto" value="{{ old('nombre_contacto') }}">
            @error('nombre_contacto')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          {{-- Telefono_contacto --}}
          <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
            <span style="color:red;">*</span>Telefono Contacto</label>
            <input type="text" class="form-control form-control-proyecto @error('telefono_contacto') is-invalid @enderror" placeholder="Numero de Telefono" name="telefono_contacto" id="telefono_contacto" value="{{ old('telefono_contacto') }}">
            @error('telefono_contacto')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

        </div>



        <div class="row">
  <div class='panel large-6 columns'>
    <div class='panel-title yellow small-12'>
      <span>proyectos</span>
    </div>
    <div class='panel-content has_many'>
      <div class='headers hide-on-med-and-down'>
        <div class="small-12 medium-12 large-12 columns">
          <div class='medium-12 large-12 columns'><span>proyectos</span></div>
        </div>
      </div>
      <div id='proyectos_items' class='has-many-items'>
        
      </div>
      <div class='row'>
        <a href='#' class='add-has_many fa fa-plus' data-target-id='proyectos_items' id='add_proyectos'></a>
      </div>
      <div id='proyectos_items_template' style='display:none;'>

      </div>
    </div>
  </div>
</div>




      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-success btn-proyecto float-right mb-3">Guardar</button>
        <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('proyectos') }}">Cancelar</a>
      </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  var addInputsBtn = document.getElementById('add-inputs-btn');
  var dynamicInputsDiv = document.getElementById('dynamic-inputs');
  var inputCount = 2; // Iniciamos el contador en 1

  addInputsBtn.addEventListener('click', function() {
    var inputGroup = document.createElement('div');
    inputGroup.classList.add('form-group', 'row');

    var input1Div = document.createElement('div');
    input1Div.classList.add('col-sm-6', 'mb-3', 'mt-3', 'mb-sm-0');
    var input1Label = document.createElement('label');
    input1Label.setAttribute('for', 'input' + inputCount);
    input1Label.textContent = 'Descripción';
    var input1 = document.createElement('input');
    input1.setAttribute('type', 'text');
    input1.classList.add('form-control');
    input1.setAttribute('name', 'input' + inputCount);

    var input2Div = document.createElement('div');
    input2Div.classList.add('col-sm-6', 'mb-3', 'mt-3', 'mb-sm-0');
    var input2Label = document.createElement('label');
    input2Label.setAttribute('for', 'input' + (inputCount));
    input2Label.textContent = 'URL';
    var input2 = document.createElement('input');
    input2.setAttribute('type', 'text');
    input2.classList.add('form-control');
    input2.setAttribute('name', 'input' + (inputCount));

    input1Div.appendChild(input1Label);
    input1Div.appendChild(input1);
    input2Div.appendChild(input2Label);
    input2Div.appendChild(input2);

    inputGroup.appendChild(input1Div);
    inputGroup.appendChild(input2Div);

    dynamicInputsDiv.appendChild(inputGroup);

    inputCount += 1; // Incrementa el contador en 2
  });
});

</script>
@endsection

@section('scripts')
@show