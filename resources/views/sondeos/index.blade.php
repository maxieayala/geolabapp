@extends('layouts.app')

@section('title', 'Proyectos')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Listado de Sondeos Realizados</h1>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('sondeo.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Agregar
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="" class="btn btn-sm btn-success">
                        <i class="fas fa-check"></i> Exportar
                    </a>
                </div>
            </div>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sondeos</h6>
                <form method="GET" action="{{ route('sondeo.index') }}"
                    class="d-sm-inline-block form-inline navbar-search w-50">
                    <div class="py-2 flex">
                        <div class="input-group mb-3">
                            <input type="search" name="search" id="search" value="{{ request()->input('search') }}"
                                class="form-control small" placeholder="Buscar por cliente,proyecto" aria-label="Search"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type='submit'>
                                    <i class="fas fa-search fa-sm"></i>
                                    Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="SondeoTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%"><i class="fa fa-id-badge" aria-hidden="true"></i> Cliente</th>
                                <th width="5%">Nombre Proyecto</th>
                                <th width="2%"><i class="fa fa-globe" aria-hidden="true"></i>Coordenada X</th>
                                <th width="2%"><i class="fa fa-globe" aria-hidden="true"></i>Coordenada Y</th>
                                <th width="2%">Total de Muestras</th>

                                <th width="3%">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sondeos as $sondeo)
                                <tr>
                                    <td>{{ $sondeo->nombre_cliente }}</td>
                                    <td>{{ $sondeo->nombre_proyecto }}</td>


                                    <td>{{ $sondeo->coordenada_x }}</td>
                                    <td>{{ $sondeo->coordenada_y }}</td>
                                    <td>{{ $sondeo->ObtenerTotalMuestras() }}</td>

                                    <td style="display: flex">
                                        <a id="Vermapa" data-toggle="modal" data-target="#vermapaModal"
                                            class="btn btn-primary m-2">
                                            <i class="fas fa-map"></i>
                                        </a>
                                        <a href="{{ route('sondeo.edit', ['sondeo' => $sondeo]) }}"
                                            class="btn btn-primary m-2">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <a href="{{ route('sondeo.destroy', $sondeo->id) }}" class="btn btn-danger m-2"
                                            onclick="
                          event.preventDefault();
                          if (confirm('¿Estás seguro de eliminar el sondeo?')) {
                            document.getElementById('delete-form-{{ $sondeo->id }}').submit();
                          }
                        ">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <form id="delete-form-{{ $sondeo->id }}"
                                            action="{{ route('sondeo.destroy', $sondeo->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <span style="color:red;">*</span>No se encontraro registros
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    {{ $sondeos->links() }}

                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')

    @include('sondeos.mapasondeo')


@endsection
