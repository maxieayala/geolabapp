<div class="modal fade bd-example-modal-lg" id="SondeoAddModal" tabindex="-1" role="dialog"
    aria-labelledby="ModalLabelSondeo" aria-hidden="true">



    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelSondeo">Agregar Sondeo y Muestras</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="limpiarModal()">
                    <span aria-hidden="true">×</span>
                </button>

            </div>
            <div class="modal-body">
                <!-- DataTales Example -->
                <div class="card-body">
                    <form method="POST" id="SondeoForm" method="POST">
                        @csrf
                        <input type="text" name="proyecto_id" id="proyecto_id" value="" hidden>

                        <div class="form-row">

                            <div class="col-sm-6 mb-2 mb-sm-0">
                                <span style="color:red;">*</span>Fecha</label>
                                <input type="date"
                                    class="form-control form-control-user @error('Fecha') is-invalid @enderror"
                                    id="fecha" placeholder="Fecha" name="fecha" value="{{ old('fecha') }}">

                                @error('Fecha')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6 mb-2 mb-sm-0">
                                <span style="color:red;">*</span>Estación</label>
                                <input type="text"
                                    class="form-control form-control-user @error('estacion') is-invalid @enderror"
                                    id="estacion" placeholder="Estación" name="estacion" value="{{ old('estacion') }}">

                                @error('estacion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6 mb-2 mb-sm-0">
                                <span style="color:red;">*</span>Banda</label>
                                <input type="text"
                                    class="form-control form-control-user @error('banda') is-invalid @enderror"
                                    id="banda" placeholder="banda" name="banda" value="{{ old('banda') }}">

                                @error('banda')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group col-md-2 ">
                                <label for="coordenada_x">Coordenada X</label>
                                <input type="number" class="form-control form-control-sm" id="coordenada_x"
                                    name="coordenada_x" value="{{ old('coordenada_x') }}" placeholder="X">
                            </div>
                            <div class="form-group col-md-2 ">
                                <label for="coordenada_x">Coordenada Y</label>
                                <input type="number" class="form-control form-control-sm" id="coordenada_y"
                                    name="coordenada_y" value="{{ old('coordenada_y') }}" placeholder="Y">
                            </div>


                        </div>
                        <div>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                        href="#nav-home" role="tab" aria-controls="nav-home"
                                        aria-selected="true">Muestras</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                        href="#nav-profile" role="tab" aria-controls="nav-profile"
                                        aria-selected="false">SPT</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    @include('sondeos.muestras')
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    @include('sondeos.spt')
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- **************Fin de formulario --}}
                </div>
                <div class="modal-footer">
                    <button type="submit" type="button" class="btn btn-primary" id="GuardarSondeo">Guardar</button>

                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                </div>

            </div>
        </div>
    </div>


    <script>
        function limpiarModal() {
            // Restablecer los valores de los inputs
            document.getElementById('fecha').value = '';
            document.getElementById('estacion').value = '';


        }
        $('#GuardarSondeo').click(function() {

            event.preventDefault();
            $.ajax({
                // url: "{{ route('sondeoAdd') }}",
                url: "/sondeoAdd",
                method: "POST",
                data: $('#SondeoForm').serialize(),
                dataType: "json",
                success: function(data) {
                    $('#notificacion-alerta').removeClass().addClass('alert alert-success').html(
                        '<strong>Registro Guardado exitosamente!</strong>');

                    $('#SondeoAddModal').modal('hide');
                    $("#GuardarSondeo").find('input').val('');
                    $('#proyecto').trigger(
                        'change'
                    );


                    $('#SondeoTable').DataTable().ajax.reload();

                },
                error: function(data, status, error) {
                    err = JSON.parse(data.responseText);
                    console.log(err.errors);

                    $('#SondeoAddModal').modal('hide');
                    html = '<p><strong>' + data.statusText + '</strong></p><p>' + err.message + '</p>';
                    $.each(err.errors, function(index, value) {
                        html += '<p>' + value + '</p>';
                    });

                    $('#notificacion-alerta').removeClass().addClass('alert alert-warning').html(html);
                    cant_test = 1;
                }

            });
            $('#SondeoForm').trigger("reset");
            setTimeout(function() {
                $('#notificacion-alerta').html('').removeClass();
            }, 2000)
        });
    </script>
