<div class="modal fade bd-example-modal-lg" id="SondeoAddModal" tabindex="-1" role="dialog"
    aria-labelledby="ModalLabelSondeo" aria-hidden="true">

    <input type="hidden" name="proyecto_id" id="proyecto_id" value="">

    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelSondeo">Agregar sondeos y Muestras</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- DataTales Example -->
                <div class="card-body">
                    <form method="POST" id="SondeoForm" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="form-group  col-md-3">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control form-control-sm" id="fecha" name="fecha"
                                    value="{{ old('fecha') }}">
                            </div>
                            <div class="form-group  col-md-3">
                                <label for="estacion">Estación</label>
                                <input type="text" class="form-control form-control-sm" id="estacion"
                                    name="estacion" value="{{ old('estacion') }}">
                            </div>
                            <div class="form-group  col-md-3">
                                <label for="banda">Banda</label>
                                <input type="text" class="form-control form-control-sm" id="banda" name="banda"
                                    value="{{ old('banda') }}">
                            </div>
                            <div class="form-group col-md-3 ">
                                <label for="coordenada_x">Coordenadas</label>
                                <input type="number" class="form-control form-control-sm" id="coordenada_x"
                                    name="coordenada_x" value="{{ old('coordenada_x') }}" placeholder="X">
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
                    <button type="submit" type="button" class="btn btn-primary">Guardar</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#SondeoForm').on('submit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var myformData = new FormData($('#SondeoForm')[0]);
            $.ajax({
                url: "/sondeoAdd",
                type: "POST",
                data: {
                    coordenada_x: document.getElementById("coordenada_x").value,
                    coordenada_y: document.getElementById("coordenada_y").value,
                    banda: document.getElementById("banda").value,
                    estacion: document.getElementById("estacion").value,
                    proyecto_id: document.getElementById("proyecto_id").value,
                    fecha: document.getElementById("fecha").value
                },
                data: myformData,
                cache: false,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $("#SondeoForm").find('input').val('');
                    $('#SondeoAddModal').modal('hide');
                    // $('#medicineaddform')[0].reset();
                    Swal.fire({
                        position: 'top-mid',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 1800
                    });
                    // table.draw();
                    location.reload();
                },
                error: function(error) {
                    console.log(error);
                    alert("Error al guardar");
                }
            });


        });
    </script>
