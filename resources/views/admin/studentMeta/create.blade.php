@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.studentMetum.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.student-meta.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="meta_key">{{ trans('cruds.studentMetum.fields.meta_key') }}</label>
                <input class="form-control {{ $errors->has('meta_key') ? 'is-invalid' : '' }}" type="text" name="meta_key" id="meta_key" value="{{ old('meta_key', '') }}" required>
                @if($errors->has('meta_key'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta_key') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentMetum.fields.meta_key_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="meta_value">{{ trans('cruds.studentMetum.fields.meta_value') }}</label>
                <input class="form-control {{ $errors->has('meta_value') ? 'is-invalid' : '' }}" type="text" name="meta_value" id="meta_value" value="{{ old('meta_value', '') }}">
                @if($errors->has('meta_value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta_value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentMetum.fields.meta_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="student_id">{{ trans('cruds.studentMetum.fields.student') }}</label>
                <select class="form-control select2 {{ $errors->has('student') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                    @foreach($students as $id => $entry)
                        <option value="{{ $id }}" {{ old('student_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('student'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentMetum.fields.student_helper') }}</span>
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