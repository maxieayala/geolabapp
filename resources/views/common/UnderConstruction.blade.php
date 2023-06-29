@auth
    @extends('layouts.app')

    @section('title', 'En construccion')

@section('content')
    <div class="container-fluid">


        <div class="text-center">
            <div class="error mx-auto">🚧</div>
            <p class="lead text-gray-800 mb-5">Pagina en construcción</p>
            <p class="text-gray-500 mb-0">Estamos trabajando en ello...</p>
            <a href="{{ route('home') }}">← Regreasr</a>
        </div>

    </div>
@endsection
@endauth
