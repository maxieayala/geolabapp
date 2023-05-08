@extends('layouts.app')

@section('title', 'clientes')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Listado de clientes</h1>
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('clientes_Add') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Agregar
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('clientes_Exportar') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-check"></i> Exportar
                </a>
            </div>

        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Clientes</h6>
                <form method="GET" action="{{ route('clientes') }}"
                    class="d-sm-inline-block form-inline navbar-search w-50">
                    <div class="py-2 flex">
                        <div class="input-group mb-3">

                            <input type="search" name="search" id="search" value="{{ request()->input('search') }}"
                                class="form-control small" placeholder="Nombre cliente" aria-label="Search"
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
            <div class="card-body">r
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">Nombre cliente</th>
                                <th width="5%">Email</th>
                                <th width="5%">Telefono</th>
                                <th width="5%">Tipo Cliente</th>
                                <th width="3%">Opciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($clientes as $cliente)
                            <tr>
                                <td>{{$cliente->Nombre}}</td>
                                <td>{{$cliente->email}}</td>
                                <td>{{$cliente->telefono}}</td>
                                <td>{{$cliente->gettipocliente()}}</td>
                                <td style="display: flex">
                                    <a href="{{ route('cliente_edit', ['cliente' => $cliente->id]) }}"
                                        class="btn btn-primary m-2">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a class="btn btn-danger m-2" href="#" data-toggle="modal"
                                        data-target="#deleteModal">
                                        <i class="fas fa-trash"></i>
                                    </a>
                            </tr>
                            @empty
                            <tr>
                                <span style="color:red;">*</span>SIN REGISTROS
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                    {{ $clientes->links() }}

                </div>
            </div>
        </div>

    </div>


    @endsection
