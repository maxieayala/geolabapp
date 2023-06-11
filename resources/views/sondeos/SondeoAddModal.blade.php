<div class="modal fade bd-example-modal-lg" id="SondeoAddModal" tabindex="-1" role="dialog"
    aria-labelledby="ModalLabelSondeo" aria-hidden="true">
    {{-- <input name="Proyecto_id" value="{{ $ttr->id }}" type="hidden"> --}}
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelSondeo">¿Estas seguro de salir?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- DataTales Example -->
                <div class="card-body">
                    <form method="POST" action="{{ route('sondeo.store') }}">
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
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Salir
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
