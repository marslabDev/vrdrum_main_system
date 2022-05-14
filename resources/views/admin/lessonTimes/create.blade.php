@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.lessonTime.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lesson-times.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="lesson_code">{{ trans('cruds.lessonTime.fields.lesson_code') }}</label>
                <input class="form-control {{ $errors->has('lesson_code') ? 'is-invalid' : '' }}" type="text" name="lesson_code" id="lesson_code" value="{{ old('lesson_code', '') }}" required>
                @if($errors->has('lesson_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTime.fields.lesson_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_from">{{ trans('cruds.lessonTime.fields.date_from') }}</label>
                <input class="form-control datetime {{ $errors->has('date_from') ? 'is-invalid' : '' }}" type="text" name="date_from" id="date_from" value="{{ old('date_from') }}" required>
                @if($errors->has('date_from'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_from') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTime.fields.date_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_to">{{ trans('cruds.lessonTime.fields.date_to') }}</label>
                <input class="form-control datetime {{ $errors->has('date_to') ? 'is-invalid' : '' }}" type="text" name="date_to" id="date_to" value="{{ old('date_to') }}" required>
                @if($errors->has('date_to'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_to') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTime.fields.date_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="class_room_id">{{ trans('cruds.lessonTime.fields.class_room') }}</label>
                <select class="form-control select2 {{ $errors->has('class_room') ? 'is-invalid' : '' }}" name="class_room_id" id="class_room_id">
                    @foreach($class_rooms as $id => $entry)
                        <option value="{{ $id }}" {{ old('class_room_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('class_room'))
                    <div class="invalid-feedback">
                        {{ $errors->first('class_room') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTime.fields.class_room_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lesson_id">{{ trans('cruds.lessonTime.fields.lesson') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson') ? 'is-invalid' : '' }}" name="lesson_id" id="lesson_id">
                    @foreach($lessons as $id => $entry)
                        <option value="{{ $id }}" {{ old('lesson_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTime.fields.lesson_helper') }}</span>
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