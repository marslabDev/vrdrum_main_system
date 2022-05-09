@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.lessonTimeChange.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lesson-time-changes.update", [$lessonTimeChange->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="old_lesson_time_id">{{ trans('cruds.lessonTimeChange.fields.old_lesson_time') }}</label>
                <select class="form-control select2 {{ $errors->has('old_lesson_time') ? 'is-invalid' : '' }}" name="old_lesson_time_id" id="old_lesson_time_id" required>
                    @foreach($old_lesson_times as $id => $entry)
                        <option value="{{ $id }}" {{ (old('old_lesson_time_id') ? old('old_lesson_time_id') : $lessonTimeChange->old_lesson_time->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('old_lesson_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('old_lesson_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeChange.fields.old_lesson_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_from">{{ trans('cruds.lessonTimeChange.fields.date_from') }}</label>
                <input class="form-control datetime {{ $errors->has('date_from') ? 'is-invalid' : '' }}" type="text" name="date_from" id="date_from" value="{{ old('date_from', $lessonTimeChange->date_from) }}" required>
                @if($errors->has('date_from'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_from') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeChange.fields.date_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="class_room_id">{{ trans('cruds.lessonTimeChange.fields.class_room') }}</label>
                <select class="form-control select2 {{ $errors->has('class_room') ? 'is-invalid' : '' }}" name="class_room_id" id="class_room_id" required>
                    @foreach($class_rooms as $id => $entry)
                        <option value="{{ $id }}" {{ (old('class_room_id') ? old('class_room_id') : $lessonTimeChange->class_room->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('class_room'))
                    <div class="invalid-feedback">
                        {{ $errors->first('class_room') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeChange.fields.class_room_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lesson_id">{{ trans('cruds.lessonTimeChange.fields.lesson') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson') ? 'is-invalid' : '' }}" name="lesson_id" id="lesson_id" required>
                    @foreach($lessons as $id => $entry)
                        <option value="{{ $id }}" {{ (old('lesson_id') ? old('lesson_id') : $lessonTimeChange->lesson->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeChange.fields.lesson_helper') }}</span>
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