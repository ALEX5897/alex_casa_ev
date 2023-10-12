@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.passenger.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.passengers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre">{{ trans('cruds.passenger.fields.nombre') }}</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre" id="nombre" value="{{ old('nombre', '') }}">
                @if($errors->has('nombre'))
                    <span class="text-danger">{{ $errors->first('nombre') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.passenger.fields.nombre_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dni">{{ trans('cruds.passenger.fields.dni') }}</label>
                <input class="form-control {{ $errors->has('dni') ? 'is-invalid' : '' }}" type="text" name="dni" id="dni" value="{{ old('dni', '') }}">
                @if($errors->has('dni'))
                    <span class="text-danger">{{ $errors->first('dni') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.passenger.fields.dni_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vuelos">{{ trans('cruds.passenger.fields.vuelo') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('vuelos') ? 'is-invalid' : '' }}" name="vuelos[]" id="vuelos" multiple>
                    @foreach($vuelos as $id => $vuelo)
                        <option value="{{ $id }}" {{ in_array($id, old('vuelos', [])) ? 'selected' : '' }}>{{ $vuelo }}</option>
                    @endforeach
                </select>
                @if($errors->has('vuelos'))
                    <span class="text-danger">{{ $errors->first('vuelos') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.passenger.fields.vuelo_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection