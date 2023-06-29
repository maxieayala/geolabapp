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
        {{-- Alert Messages --}}
        @include('common.alert')
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Sondeos Registrados</h5>
                <div id="notificacion-alerta" class="" role="alert">
                </div>

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
                    <button id="addSondeoButton"type="button" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm  "
                        data-toggle="modal" disabled=true data-target="#SondeoAddModal">
                        Agregar Sondeo
                    </button>
                </div>


                <div class="mt-3 mb-3">
                    <div class="table-responsive ">
                        <table id="sondeos" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Banda</th>
                                    <th>Coordenada X</th>
                                    <th>Coordenada Y</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Las filas se agregarán dinámicamente aquí -->
                            </tbody>
                        </table>


                    </div>

                </div>


            </div>


        </div>
        {{-- @include('sondeos.grafico') --}}
        {{-- Alert Messages
        @include('common.alert')
        @include('sondeos.formsAdd') --}}
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#sondeos').DataTable({
                "paging": false,
                "searching": false,
            });


            $(document).ready(function() {

                $('#cliente').on('change',
                    function() { // Corrección: Agrega el selector '#' para obtener el elemento por su ID

                        var clienteId = $('#cliente')
                            .val(); // Corrección: Agrega el selector '#' para obtener el elemento por su ID
                        if (clienteId) {

                            $.ajax({
                                url: '/obtenerProyectos/' + clienteId,
                                type: "GET",
                                dataType: "json",
                                success: function(data) {
                                    $('#proyecto').empty();
                                    $.each(data, function(id, nombre) {
                                        var option = $('<option></option>').attr(
                                                'value', id)
                                            .text(nombre);
                                        $('#proyecto').append(option);
                                    });
                                    $('#proyecto').trigger(
                                        'change'
                                    ); // Agrega esta línea para disparar el evento change del select de proyectos
                                    $('#addSondeoButton').prop('disabled',
                                        false
                                    ); // Agrega esta línea para habilitar el botón de agregar sondeo
                                }
                            });
                        } else {
                            $('#proyecto').empty();

                            $('#addSondeoButton').prop('disabled', true);
                        }
                    });


                $('#proyecto').on('change',
                    function() {
                        var proyectoId = $('#proyecto').val();
                        document.getElementById('proyecto_id').value = proyectoId;

                        if (proyectoId) {
                            $.ajax({
                                url: '/ObtenerSondeos/' + proyectoId,
                                type: "GET",

                                dataType: "json",
                                success: function(data) {

                                    console.log(data);
                                    var tbody = $('#sondeos tbody');
                                    tbody.empty();

                                    // Generar las filas dinámicamente
                                    data.forEach(function(sondeo) {
                                        var row = '<tr>' +
                                            '<td>' + sondeo.banda + '</td>' +
                                            '<td>' + sondeo.coordenada_x + '</td>' +
                                            '<td>' + sondeo.coordenada_y + '</td>' +
                                            '</tr>';

                                        tbody.append(row);
                                    });
                                }
                            });
                        } else {
                            $('#sondeos').DataTable().clear();
                        }
                    });


            });
        });
    </script>



    @include('sondeos.SondeoAddModal')

@endsection
