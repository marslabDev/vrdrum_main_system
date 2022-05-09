@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.lessonTimeChange.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lesson-time-changes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="old_lesson_time_id">{{ trans('cruds.lessonTimeChange.fields.old_lesson_time') }}</label>
                <select class="form-control select2 {{ $errors->has('old_lesson_time') ? 'is-invalid' : '' }}" name="old_lesson_time_id" id="old_lesson_time_id">
                    @foreach($old_lesson_times as $id => $entry)
                        <option value="{{ $id }}" {{ old('old_lesson_time_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <input class="form-control datetime {{ $errors->has('date_from') ? 'is-invalid' : '' }}" type="text" name="date_from" id="date_from" value="{{ old('date_from') }}" required>
                @if($errors->has('date_from'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_from') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeChange.fields.date_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_to">{{ trans('cruds.lessonTimeChange.fields.date_to') }}</label>
                <input class="form-control datetime {{ $errors->has('date_to') ? 'is-invalid' : '' }}" type="text" name="date_to" id="date_to" value="{{ old('date_to') }}" required>
                @if($errors->has('date_to'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_to') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeChange.fields.date_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="class_room_id">{{ trans('cruds.lessonTimeChange.fields.class_room') }}</label>
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
                <span class="help-block">{{ trans('cruds.lessonTimeChange.fields.class_room_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lesson_id">{{ trans('cruds.lessonTimeChange.fields.lesson') }}</label>
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
                <span class="help-block">{{ trans('cruds.lessonTimeChange.fields.lesson_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.lessonTimeChange.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', '') }}">
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeChange.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="request_date">{{ trans('cruds.lessonTimeChange.fields.request_date') }}</label>
                <input class="form-control datetime {{ $errors->has('request_date') ? 'is-invalid' : '' }}" type="text" name="request_date" id="request_date" value="{{ old('request_date') }}">
                @if($errors->has('request_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('request_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeChange.fields.request_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="request_user_efk">{{ trans('cruds.lessonTimeChange.fields.request_user_efk') }}</label>
                <input class="form-control {{ $errors->has('request_user_efk') ? 'is-invalid' : '' }}" type="number" name="request_user_efk" id="request_user_efk" value="{{ old('request_user_efk', '') }}" step="1" required>
                @if($errors->has('request_user_efk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('request_user_efk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeChange.fields.request_user_efk_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="response_date">{{ trans('cruds.lessonTimeChange.fields.response_date') }}</label>
                <input class="form-control datetime {{ $errors->has('response_date') ? 'is-invalid' : '' }}" type="text" name="response_date" id="response_date" value="{{ old('response_date') }}">
                @if($errors->has('response_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('response_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeChange.fields.response_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="response_user_efk">{{ trans('cruds.lessonTimeChange.fields.response_user_efk') }}</label>
                <input class="form-control {{ $errors->has('response_user_efk') ? 'is-invalid' : '' }}" type="number" name="response_user_efk" id="response_user_efk" value="{{ old('response_user_efk', '') }}" step="1">
                @if($errors->has('response_user_efk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('response_user_efk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeChange.fields.response_user_efk_helper') }}</span>
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