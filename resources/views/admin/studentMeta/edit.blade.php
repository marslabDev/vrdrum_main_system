@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.studentMetum.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.student-meta.update", [$studentMetum->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="meta_key">{{ trans('cruds.studentMetum.fields.meta_key') }}</label>
                <input class="form-control {{ $errors->has('meta_key') ? 'is-invalid' : '' }}" type="text" name="meta_key" id="meta_key" value="{{ old('meta_key', $studentMetum->meta_key) }}" required>
                @if($errors->has('meta_key'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta_key') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentMetum.fields.meta_key_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="meta_value">{{ trans('cruds.studentMetum.fields.meta_value') }}</label>
                <input class="form-control {{ $errors->has('meta_value') ? 'is-invalid' : '' }}" type="text" name="meta_value" id="meta_value" value="{{ old('meta_value', $studentMetum->meta_value) }}">
                @if($errors->has('meta_value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta_value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentMetum.fields.meta_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="student_efk">{{ trans('cruds.studentMetum.fields.student_efk') }}</label>
                <input class="form-control {{ $errors->has('student_efk') ? 'is-invalid' : '' }}" type="number" name="student_efk" id="student_efk" value="{{ old('student_efk', $studentMetum->student_efk) }}" step="1" required>
                @if($errors->has('student_efk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student_efk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentMetum.fields.student_efk_helper') }}</span>
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