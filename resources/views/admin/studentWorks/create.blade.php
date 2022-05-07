@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.studentWork.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.student-works.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>{{ trans('cruds.studentWork.fields.category') }}</label>
                <select class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category" id="category">
                    <option value disabled {{ old('category', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\StudentWork::CATEGORY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('category', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentWork.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.studentWork.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentWork.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="desc">{{ trans('cruds.studentWork.fields.desc') }}</label>
                <input class="form-control {{ $errors->has('desc') ? 'is-invalid' : '' }}" type="text" name="desc" id="desc" value="{{ old('desc', '') }}">
                @if($errors->has('desc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('desc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentWork.fields.desc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_at">{{ trans('cruds.studentWork.fields.start_at') }}</label>
                <input class="form-control datetime {{ $errors->has('start_at') ? 'is-invalid' : '' }}" type="text" name="start_at" id="start_at" value="{{ old('start_at') }}">
                @if($errors->has('start_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentWork.fields.start_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_at">{{ trans('cruds.studentWork.fields.end_at') }}</label>
                <input class="form-control datetime {{ $errors->has('end_at') ? 'is-invalid' : '' }}" type="text" name="end_at" id="end_at" value="{{ old('end_at') }}">
                @if($errors->has('end_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentWork.fields.end_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="time_given_minute">{{ trans('cruds.studentWork.fields.time_given_minute') }}</label>
                <input class="form-control {{ $errors->has('time_given_minute') ? 'is-invalid' : '' }}" type="number" name="time_given_minute" id="time_given_minute" value="{{ old('time_given_minute', '') }}" step="0.01">
                @if($errors->has('time_given_minute'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time_given_minute') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentWork.fields.time_given_minute_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lesson_time_id">{{ trans('cruds.studentWork.fields.lesson_time') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson_time') ? 'is-invalid' : '' }}" name="lesson_time_id" id="lesson_time_id">
                    @foreach($lesson_times as $id => $entry)
                        <option value="{{ $id }}" {{ old('lesson_time_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentWork.fields.lesson_time_helper') }}</span>
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