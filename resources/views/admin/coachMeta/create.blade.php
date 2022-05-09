@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.coachMetum.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.coach-meta.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="meta_key">{{ trans('cruds.coachMetum.fields.meta_key') }}</label>
                <input class="form-control {{ $errors->has('meta_key') ? 'is-invalid' : '' }}" type="text" name="meta_key" id="meta_key" value="{{ old('meta_key', '') }}" required>
                @if($errors->has('meta_key'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta_key') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coachMetum.fields.meta_key_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="meta_value">{{ trans('cruds.coachMetum.fields.meta_value') }}</label>
                <input class="form-control {{ $errors->has('meta_value') ? 'is-invalid' : '' }}" type="text" name="meta_value" id="meta_value" value="{{ old('meta_value', '') }}">
                @if($errors->has('meta_value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta_value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coachMetum.fields.meta_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="coach_efk">{{ trans('cruds.coachMetum.fields.coach_efk') }}</label>
                <input class="form-control {{ $errors->has('coach_efk') ? 'is-invalid' : '' }}" type="number" name="coach_efk" id="coach_efk" value="{{ old('coach_efk', '') }}" step="1" required>
                @if($errors->has('coach_efk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coach_efk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coachMetum.fields.coach_efk_helper') }}</span>
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