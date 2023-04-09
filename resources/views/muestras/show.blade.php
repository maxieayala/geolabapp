@extends('layouts.app')

@section('title', __('muestra.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('muestra.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('muestra.name') }}</td><td>{{ $muestra->name }}</td></tr>
                        <tr><td>{{ __('muestra.address') }}</td><td>{{ $muestra->address }}</td></tr>
                        <tr><td>{{ __('muestra.latitude') }}</td><td>{{ $muestra->latitude }}</td></tr>
                        <tr><td>{{ __('muestra.longitude') }}</td><td>{{ $muestra->longitude }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $muestra)
                    <a href="{{ route('muestras.edit', $muestra) }}" id="edit-muestra-{{ $muestra->id }}" class="btn btn-warning">{{ __('muestra.edit') }}</a>
                @endcan
                @if(auth()->check())
                    <a href="{{ route('muestras.index') }}" class="btn btn-link">{{ __('muestra.back_to_index') }}</a>
                @else
                    <a href="{{ route('muestra_map.index') }}" class="btn btn-link">{{ __('muestra.back_to_index') }}</a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ trans('muestra.location') }}</div>
            @if ($muestra->coordinate)
            <div class="card-body" id="mapid"></div>
            @else
            <div class="card-body">{{ __('muestra.no_coordinate') }}</div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>

<style>
    #mapid { height: 400px; }
</style>
@endsection
@push('scripts')
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>

<script>
    var map = L.map('mapid').setView([{{ $muestra->latitude }}, {{ $muestra->longitude }}], {{ config('leaflet.detail_zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([{{ $muestra->latitude }}, {{ $muestra->longitude }}]).addTo(map)
        .bindPopup('{!! $muestra->map_popup_content !!}');
</script>
@endpush
