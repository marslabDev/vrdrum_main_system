@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.lessonTime.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lesson-times.update", [$lessonTime->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="lesson_code">{{ trans('cruds.lessonTime.fields.lesson_code') }}</label>
                <input class="form-control {{ $errors->has('lesson_code') ? 'is-invalid' : '' }}" type="text" name="lesson_code" id="lesson_code" value="{{ old('lesson_code', $lessonTime->lesson_code) }}" required>
                @if($errors->has('lesson_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTime.fields.lesson_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_from">{{ trans('cruds.lessonTime.fields.date_from') }}</label>
                <input class="form-control datetime {{ $errors->has('date_from') ? 'is-invalid' : '' }}" type="text" name="date_from" id="date_from" value="{{ old('date_from', $lessonTime->date_from) }}" required>
                @if($errors->has('date_from'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_from') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTime.fields.date_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_to">{{ trans('cruds.lessonTime.fields.date_to') }}</label>
                <input class="form-control datetime {{ $errors->has('date_to') ? 'is-invalid' : '' }}" type="text" name="date_to" id="date_to" value="{{ old('date_to', $lessonTime->date_to) }}" required>
                @if($errors->has('date_to'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_to') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTime.fields.date_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attended_at">{{ trans('cruds.lessonTime.fields.attended_at') }}</label>
                <input class="form-control datetime {{ $errors->has('attended_at') ? 'is-invalid' : '' }}" type="text" name="attended_at" id="attended_at" value="{{ old('attended_at', $lessonTime->attended_at) }}">
                @if($errors->has('attended_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attended_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTime.fields.attended_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="leaved_at">{{ trans('cruds.lessonTime.fields.leaved_at') }}</label>
                <input class="form-control datetime {{ $errors->has('leaved_at') ? 'is-invalid' : '' }}" type="text" name="leaved_at" id="leaved_at" value="{{ old('leaved_at', $lessonTime->leaved_at) }}">
                @if($errors->has('leaved_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('leaved_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTime.fields.leaved_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="class_room_id">{{ trans('cruds.lessonTime.fields.class_room') }}</label>
                <select class="form-control select2 {{ $errors->has('class_room') ? 'is-invalid' : '' }}" name="class_room_id" id="class_room_id">
                    @foreach($class_rooms as $id => $entry)
                        <option value="{{ $id }}" {{ (old('class_room_id') ? old('class_room_id') : $lessonTime->class_room->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                        <option value="{{ $id }}" {{ (old('lesson_id') ? old('lesson_id') : $lessonTime->lesson->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <label for="student_id">{{ trans('cruds.lessonTime.fields.student') }}</label>
                <select class="form-control select2 {{ $errors->has('student') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                    @foreach($students as $id => $entry)
                        <option value="{{ $id }}" {{ (old('student_id') ? old('student_id') : $lessonTime->student->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('student'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTime.fields.student_helper') }}</span>
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