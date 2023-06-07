@extends('layouts.app')
@section('title', 'Agregar Sondeo')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Agregar Sondeo</h1>
            <a href="{{ route('clientes') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-arrow-left fa-sm text-white-50"></i> Regresar</a>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Sondeos Registrados</h5>

                {{-- Cliente --}}
                <div class="col-md-6">
                    <div class="input-group">
                        <label for="cliente"><span style="color:red;">*</span>Clientes</label>

                        <select class="input-control is-medium  @error('cliente') is-invalid @enderror" name="cliente"
                            id="cliente">
                            <option value="">Seleccionar cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->Nombre }}</option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- Fin Cliente --}}
                {{-- Proyecto --}}
                <div class="col-md-6">
                    <div class="input-group">
                        <label for="proyecto"> Proyecto:</label>
                        {{-- select sub category --}}
                        <select class="input-control is-medium" id="proyecto" name="proyecto">
                        </select>
                    </div>
                    @error('proyecto')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                {{-- Fin Proyecto --}}

            </div>
        </div>
        {{-- Alert Messages
        @include('common.alert')
        @include('sondeos.formsAdd') --}}
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var cliente = $('#cliente')
                .val(); // Corrección: Agrega el selector '#' para obtener el elemento por su ID
            $.ajax({
                url: '/getproyectos/' + cliente,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#proyecto').empty();
                    $.each(data, function(key, value) {
                        $('#proyecto').append('<option value="' + value.id + '">' + value
                            .nombre + '</option>');
                    });
                }
            });



            $('#cliente').on('change',
        function() { // Corrección: Agrega el selector '#' para obtener el elemento por su ID

                var category_id = $('#cliente')
            .val(); // Corrección: Agrega el selector '#' para obtener el elemento por su ID
                if (category_id) {
                    $.ajax({
                        url: '/getproyectos/' + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#proyecto').empty();
                            $.each(data, function(key, value) {
                                $('#proyecto').append('<option value="' + value.id +
                                    '">' + value.nombre + '</option>');
                            });
                        }
                    });
                } else {
                    $('#proyecto').empty();
                }
            });

        });
    </script>
@endsection
