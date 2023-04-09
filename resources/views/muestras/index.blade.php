@extends('layouts.app')

@section('title', __('muestra.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\muestra)
            <a href="{{ route('muestras.create') }}" class="btn btn-success">{{ __('muestra.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('muestra.list') }} <small>{{ __('app.total') }} : {{ $muestras->total() }} {{ __('muestra.muestra') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="control-label">{{ __('muestra.search') }}</label>
                        <input placeholder="{{ __('muestra.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('muestra.search') }}" class="btn btn-secondary">
                    <a href="{{ route('muestras.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('muestra.name') }}</th>
                        <th>{{ __('muestra.address') }}</th>
                        <th>{{ __('muestra.latitude') }}</th>
                        <th>{{ __('muestra.longitude') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($muestras as $key => $muestra)
                    <tr>
                        <td class="text-center">{{ $muestras->firstItem() + $key }}</td>
                        <td>{!! $muestra->name_link !!}</td>
                        <td>{{ $muestra->address }}</td>
                        <td>{{ $muestra->latitude }}</td>
                        <td>{{ $muestra->longitude }}</td>
                        <td class="text-center">
                            <a href="{{ route('muestras.show', $muestra) }}" id="show-muestra-{{ $muestra->id }}">{{ __('app.show') }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $muestras->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
