@extends('layouts.app')

@section('title', 'Album de Proyecto')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Listado de registros por Prtoyecto</h1>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('proyectosAgregar') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Agregar
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('proyectosExportar') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-check"></i> Exportar
                    </a>
                </div>
            </div>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Proyectos</h6>
                <form method="GET" action="{{ route('proyectos') }}"
                    class="d-sm-inline-block form-inline navbar-search w-50">
                    <div class="py-2 flex">
                        <div class="input-group mb-3">
                            <input type="search" name="search" id="search" value="{{ request()->input('search') }}"
                                class="form-control small" placeholder="Buscar por Cedula, Numero de Prestamo"
                                aria-label="Search" aria-describedby="basic-addon2">
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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">Cliente</th>
                                <th width="5%">Nombre Proyecto</th>
                                <th width="5%">Status</th>
                                <th width="5%">Fecha Inicio</th>
                                <th width="5%">Fecha Fin</th>
                                <th width="3%">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($proyectos as $proyecto)
                                <tr>
                                    <td>{{ $proyecto->nombre_cliente }}</td>
                                    <td>{{ $proyecto->nombre }}</td>
                                    <td>{{ $proyecto->status }}</td>
                                    <td>{{ $proyecto->fecha_inicio }}</td>
                                    <td>{{ $proyecto->fecha_fin }}</td>
                                    <td style="display: flex">
                                        <a href="{{ route('proyectos.show', ['proyecto' => $proyecto->id]) }}"
                                            class="btn btn-primary m-2">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('proyecto_edit', ['proyecto' => $proyecto->id]) }}"
                                            class="btn btn-primary m-2">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <a href="{{ route('proyectos.destroy', $proyecto->id) }}"
                                            class="btn btn-danger m-2"
                                            onclick="
                          event.preventDefault();
                          if (confirm('¿Estás seguro de eliminar el proyecto?')) {
                            document.getElementById('delete-form-{{ $proyecto->id }}').submit();
                          }
                        ">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <form id="delete-form-{{ $proyecto->id }}"
                                            action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST"
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
                    {{ $proyectos->links() }}

                </div>
            </div>
        </div>

    </div>

@endsection
