
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Agregar nuevo</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('sondeo.store') }}">
                    @csrf
                    <div class="form-row">

                        <div class="form-group col-md-3 ">

                            <label for="coordenada_x">Coordenada X</label>

                            <input type="number" class="form-control form-control-sm" id="coordenada_x" name="coordenada_x"
                                value="{{ old('coordenada_x') }}">

                        </div>

                        <div class="form-group  col-md-3">
                            <label for="coordenada_y">Coordenada Y</label>

                            <input type="number" class="form-control form-control-sm" id="coordenada_y" name="coordenada_y"
                                value="{{ old('coordenada_y') }}">

                        </div>

                        <div class="form-group  col-md-3">
                            <label for="estacion">Estación</label>
                            <input type="text" class="form-control form-control-sm" id="estacion" name="estacion"
                                value="{{ old('estacion') }}">
                        </div>

                        <div class="form-group  col-md-3">
                            <label for="banda">Banda</label>
                            <input type="text" class="form-control form-control-sm" id="banda" name="banda"
                                value="{{ old('banda') }}">
                        </div>

                        <div class="form-group  col-md-3">
                            <label for="tipo_sondeo_id">Tipo de Sondeo ID</label>
                            <input type="text" class="form-control form-control-sm" id="tipo_sondeo_id"
                                name="tipo_sondeo_id" value="{{ old('tipo_sondeo_id') }}">
                        </div>

                        <div class="form-group  col-md-3">
                            <label for="proyecto_id">Proyecto ID</label>
                            <input type="text" class="form-control form-control-sm" id="proyecto_id" name="proyecto_id"
                                value="{{ old('proyecto_id') }}">
                        </div>

                        <div class="form-group  col-md-3">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control form-control-sm" id="fecha" name="fecha"
                                value="{{ old('fecha') }}">
                        </div>

                        <div class="form-group  col-md-3">
                            <label for="metodos_perforacion">Métodos de Perforación</label>
                            <input type="text" class="form-control form-control-sm" id="metodos_perforacion"
                                name="metodos_perforacion" value="{{ old('metodos_perforacion') }}">
                        </div>

                        <div class="form-group  col-md-3">
                            <label for="instrumentacion">Instrumentación</label>
                            <input type="text" class="form-control form-control-sm" id="instrumentacion"
                                name="instrumentacion" value="{{ old('instrumentacion') }}">
                        </div>



                    </div>
                    <div>
                        @include('sondeos.grafico')
 

                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                    role="tab" aria-controls="nav-home" aria-selected="true">Muestras</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                    role="tab" aria-controls="nav-profile" aria-selected="false">SPT</a>

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
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-user float-right mb-3">Guardar</button>
                        <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('sondeo.index') }}">Cancelar</a>
                    </div>
            </div>
            </form>
            {{-- **************Fin de formulario --}}
        </div>
