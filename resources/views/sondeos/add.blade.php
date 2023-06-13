@extends('layouts.app')
@section('title', 'Agregar Sondeo')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Agregar Sondeo</h1>
            <a href="{{ route('home') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-arrow-left fa-sm text-white-50"></i> Regresar</a>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Sondeos Registrados</h5>

                <div class="row">
                    <div class="col-md-4 mb-3 mt-3 mb-sm-0">
                        <div class="input-group">

                            <select class="form-control form-control-user is-medium @error('cliente') is-invalid @enderror"
                                name="cliente" id="cliente">
                                <option value="">Seleccionar Cliente</option>
                                @foreach ($clientes as $id => $cliente)
                                    <option value="{{ $id }}">{{ $cliente }}</option>
                                @endforeach
                            </select>
                            @error('cliente')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mt-3 mb-sm-0">
                        <div class="input-group">

                            <select class="input-control is-medium form-control form-control-user" id="proyecto"
                                name="proyecto">
                                <option value="">Seleccionar Proyecto</option>
                            </select>
                        </div>
                        @error('proyecto')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="button" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                        data-target="#SondeoAddModal">
                        Agregar Sondeo
                    </button>
                </div>

            </div>
            <table id="miGrid" class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <!-- Agrega más columnas según tus necesidades -->
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
        {{-- @include('sondeos.grafico') --}}
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
                    $.each(data, function(id, nombre) {
                        var option = $('<option></option>').attr('value', id).text(nombre);
                        $('#proyecto').append(option);
                    });
                    $('#proyecto').trigger(
                        'change'
                    ); // Agrega esta línea para disparar el evento change del select de proyectos
                }
            });


            $('#cliente').on('change',
                function() { // Corrección: Agrega el selector '#' para obtener el elemento por su ID

                    var clienteId = $('#cliente')
                        .val(); // Corrección: Agrega el selector '#' para obtener el elemento por su ID
                    if (clienteId) {
                        $.ajax({
                            url: '/getproyectos/' + clienteId,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#proyecto').empty();
                                $.each(data, function(id, nombre) {
                                    var option = $('<option></option>').attr('value', id)
                                        .text(nombre);
                                    $('#proyecto').append(option);
                                });
                                $('#proyecto').trigger(
                                    'change'
                                ); // Agrega esta línea para disparar el evento change del select de proyectos

                            }
                        });
                    } else {
                        $('#proyecto').empty();
                    }
                });


            $('#proyecto').on('change',
                function() { // Corrección: Agrega el selector '#' para obtener el elemento por su ID

                    var proyectoId = $('#proyecto')
                        .val(); // Corrección: Agrega el selector '#' para obtener el elemento por su ID
                    if (proyectoId) {
                        $.ajax({
                            url: '/getSondeos/' + proyectoId,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#miGrid').DataTable({
                                    data: data,
                                    columns: [{
                                            title: 'ID',
                                            data: 'id'
                                        },
                                        {
                                            title: 'Nombre',
                                            data: 'nombre'
                                        },

                                        // Agrega más columnas según tus necesidades
                                    ]
                                });
                            }
                        });
                    } else {
                        $('#proyecto').empty();
                    }
                });

        });
    </script>

    @include('sondeos.SondeoAddModal')
@endsection
