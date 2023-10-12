@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.flight.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.flights.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.flight.fields.id') }}
                        </th>
                        <td>
                            {{ $flight->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.flight.fields.name') }}
                        </th>
                        <td>
                            {{ $flight->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.flight.fields.ruta') }}
                        </th>
                        <td>
                            {{ $flight->ruta }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.flight.fields.pasajero') }}
                        </th>
                        <td>
                            @foreach($flight->pasajeros as $key => $pasajero)
                                <span class="label label-info">{{ $pasajero->nombre }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.flights.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection