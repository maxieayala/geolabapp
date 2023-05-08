@extends('layouts.app')

@section('title', 'Add Users')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Agregar usuarios</h1>
            <a href="{{ route('users.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-arrow-left fa-sm text-white-50"></i> Regresar</a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Agregar nuevo usuario/h6>
            </div>
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        {{-- First Name --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Nombre</label>
                            <input type="text"
                                class="form-control form-control-user @error('first_name') is-invalid @enderror"
                                id="exampleFirstName" placeholder="Primer Nombre" name="first_name"
                                value="{{ old('first_name') }}">

                            @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Last Name --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Apellido</label>
                            <input type="text"
                                class="form-control form-control-user @error('last_name') is-invalid @enderror"
                                id="exampleLastName" placeholder="Last Name" name="last_name"
                                value="{{ old('last_name') }}">

                            @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Correo</label>
                            <input type="email"
                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                id="exampleEmail" placeholder="Email" name="email" value="{{ old('email') }}">

                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Mobile Number --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">

                            <span style="color:red;">*</span>Celular</label>
                            <input type="text"

                                class="form-control form-control-user @error('mobile_number') is-invalid @enderror"
                                id="exampleMobile" placeholder="Numero de Telefono" name="mobile_number"
                                value="{{ old('mobile_number') }}">

                            @error('mobile_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Rol</label>
                            <select class="form-control form-control-user @error('role_id') is-invalid @enderror"
                                name="role_id">
                                <option selected disabled>Seleccionar rol</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Estado</label>
                            <select class="form-control form-control-user @error('status') is-invalid @enderror"
                                name="status">
                                <option selected disabled>Seleccionar estado</option>
                                <option value="1" selected>Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">Guardar</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('users.index') }}">Cancelar</a>
                </div>
            </form>
        </div>

    </div>


@endsection
