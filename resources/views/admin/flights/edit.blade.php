@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.flight.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.flights.update", [$flight->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.flight.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $flight->name) }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.flight.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ruta">{{ trans('cruds.flight.fields.ruta') }}</label>
                <input class="form-control {{ $errors->has('ruta') ? 'is-invalid' : '' }}" type="text" name="ruta" id="ruta" value="{{ old('ruta', $flight->ruta) }}">
                @if($errors->has('ruta'))
                    <span class="text-danger">{{ $errors->first('ruta') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.flight.fields.ruta_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pasajeros">{{ trans('cruds.flight.fields.pasajero') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('pasajeros') ? 'is-invalid' : '' }}" name="pasajeros[]" id="pasajeros" multiple>
                    @foreach($pasajeros as $id => $pasajero)
                        <option value="{{ $id }}" {{ (in_array($id, old('pasajeros', [])) || $flight->pasajeros->contains($id)) ? 'selected' : '' }}>{{ $pasajero }}</option>
                    @endforeach
                </select>
                @if($errors->has('pasajeros'))
                    <span class="text-danger">{{ $errors->first('pasajeros') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.flight.fields.pasajero_helper') }}</span>
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