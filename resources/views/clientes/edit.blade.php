@extends('layouts.app')

@section('title', 'Edit cliente')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit clientes</h1>
            <a href="{{ route('clientes') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-arrow-left fa-sm text-white-50"></i> Regresar</a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Editar clientes</h6>
            </div>
            <form method="POST" action="{{ route('Cliente-update', ['cliente' => $cliente->id]) }}">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-group row">

                        {{-- First Name --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Nombre</label>
                            <input type="text"
                                class="form-control form-control-cliente @error('first_name') is-invalid @enderror"
                                id="exampleFirstName" placeholder="Primer Nombre" name="first_name"
                                value="{{ old('first_name') ? old('first_name') : $cliente->Nombre }}">

                            @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Email</label>
                            <input type="email"
                                class="form-control form-control-cliente @error('email') is-invalid @enderror"
                                id="exampleEmail" placeholder="Email" name="email"
                                value="{{ old('email') ? old('email') : $cliente->email }}">

                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-cliente float-right mb-3">Actualizar</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('clientes') }}">Cancelar</a>
                </div>
            </form>
        </div>

    </div>


@endsection
