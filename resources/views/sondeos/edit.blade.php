@extends('layouts.app')

@section('title', 'Editar Sondeo')

@section('content')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Editar Sondeo</h1>
            <a href="{{ route('sondeo.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i>
                Regresar
            </a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Editar Sondeo</h6>
            </div>
            <form method="POST" action="{{ route('sondeo.update', $sondeo->id) }}">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-group row">

                        <div class="col-sm-6 mb-2 mb-sm-0">
                            <span style="color:red;">*</span>Fecha</label>
                            <input type="date"
                                class="form-control form-control-user @error('Fecha') is-invalid @enderror" id="fecha"
                                placeholder="Fecha" name="fecha"
                                value="{{ old('fecha') ? old('fecha') : $sondeo->fecha }}">

                            @error('Fecha')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-2 mb-sm-0">
                            <span style="color:red;">*</span>Estación</label>
                            <input type="text"
                                class="form-control form-control-user @error('estacion') is-invalid @enderror"
                                id="estacion" placeholder="Estación" name="estacion"
                                value="{{ old('estacion') ? old('estacion') : $sondeo->estacion }}">

                            @error('estacion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-6 mb-2 mb-sm-0">
                            <span style="color:red;">*</span>Banda</label>
                            <input type="text"
                                class="form-control form-control-user @error('banda') is-invalid @enderror" id="banda"
                                placeholder="banda" name="banda"
                                value="{{ old('banda') ? old('banda') : $sondeo->banda }}">

                            @error('banda')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group col-md-2 ">
                            <label for="coordenada_x">Coordenada X</label>
                            <input type="number" class="form-control form-control-sm" id="coordenada_x" name="coordenada_x"
                                value="{{ old('coordenada_x') ? old('coordenada_x') : $sondeo->coordenada_x }}"
                                placeholder="X">
                        </div>
                        <div class="form-group col-md-2 ">
                            <label for="coordenada_x">Coordenada Y</label>
                            <input type="number" class="form-control form-control-sm" id="coordenada_y" name="coordenada_y"
                                value="{{ old('coordenada_y') ? old('coordenada_y') : $sondeo->coordenada_y }}"
                                placeholder="Y">
                        </div>



                    </div>
                    <table class="table table-striped" id="MuestraDatatable">
                        <thead>
                            <tr>
                                <th>
                                    <i class="fa fa-caret-square-o-up"></i>
                                    Desde
                                </th>
                                <th><i class="fa fa-caret-square-o-down"></i>
                                    Hasta</th>
                                <th><i class="fa fa-file-text-o"></i>
                                    Descripción
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí puedes cargar las filas existentes de la base de datos si las hay -->
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-Sondeo float-right mb-3">Actualizar</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('sondeo.index') }}">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#MuestraDatatable').DataTable();
        });
    </script>


@endsection
