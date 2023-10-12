@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.passenger.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.passengers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.passenger.fields.id') }}
                        </th>
                        <td>
                            {{ $passenger->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.passenger.fields.nombre') }}
                        </th>
                        <td>
                            {{ $passenger->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.passenger.fields.dni') }}
                        </th>
                        <td>
                            {{ $passenger->dni }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.passenger.fields.vuelo') }}
                        </th>
                        <td>
                            @foreach($passenger->vuelos as $key => $vuelo)
                                <span class="label label-info">{{ $vuelo->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.passengers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection