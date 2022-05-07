@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.studentDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.student-details.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="full_name">{{ trans('cruds.studentDetail.fields.full_name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', '') }}" required>
                @if($errors->has('full_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('full_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="parent_name">{{ trans('cruds.studentDetail.fields.parent_name') }}</label>
                <input class="form-control {{ $errors->has('parent_name') ? 'is-invalid' : '' }}" type="text" name="parent_name" id="parent_name" value="{{ old('parent_name', '') }}">
                @if($errors->has('parent_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parent_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.parent_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="parent_phone">{{ trans('cruds.studentDetail.fields.parent_phone') }}</label>
                <input class="form-control {{ $errors->has('parent_phone') ? 'is-invalid' : '' }}" type="text" name="parent_phone" id="parent_phone" value="{{ old('parent_phone', '') }}">
                @if($errors->has('parent_phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parent_phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.parent_phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="group">{{ trans('cruds.studentDetail.fields.group') }}</label>
                <input class="form-control {{ $errors->has('group') ? 'is-invalid' : '' }}" type="text" name="group" id="group" value="{{ old('group', '') }}" required>
                @if($errors->has('group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.group_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_disabled') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_disabled" id="is_disabled" value="1" required {{ old('is_disabled', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="is_disabled">{{ trans('cruds.studentDetail.fields.is_disabled') }}</label>
                </div>
                @if($errors->has('is_disabled'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_disabled') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.is_disabled_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="student_id">{{ trans('cruds.studentDetail.fields.student') }}</label>
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
                <span class="help-block">{{ trans('cruds.studentDetail.fields.student_helper') }}</span>
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