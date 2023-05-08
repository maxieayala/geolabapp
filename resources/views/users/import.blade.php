@extends('layouts.app')

@section('title', 'Import Users')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Importar usuarios</h1>
        <a href="{{route('users.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Regresar</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Importar Usuarios</h6>
        </div>
        <form method="POST" action="{{route('users.upload')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    
                    <div class="col-md-12 mb-3 mt-3">
                        <p>Por favor suba un archivo en el formato CSV a como se indica en este ejemplo: <a href="{{ asset('files/sample-data-sheet.csv') }}" target="_blank"> Ejemplo de formato CSV</a></p>
                    </div>
                    {{-- File Input --}}
                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Archivo requerido(Hoja de excel)</label>
                        <input 
                            type="file" 
                            class="form-control form-control-user @error('file') is-invalid @enderror" 
                            id="exampleFile"
                            name="file" 
                            value="{{ old('file') }}">

                        @error('file')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Subir archivo</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('users.index') }}">Cancelar</a>
            </div>
        </form>
    </div>

</div>


@endsection