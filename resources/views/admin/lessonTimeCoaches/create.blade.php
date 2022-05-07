@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.lessonTimeCoach.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lesson-time-coaches.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="lesson_time_id">{{ trans('cruds.lessonTimeCoach.fields.lesson_time') }}</label>
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
                <span class="help-block">{{ trans('cruds.lessonTimeCoach.fields.lesson_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="coach_id">{{ trans('cruds.lessonTimeCoach.fields.coach') }}</label>
                <select class="form-control select2 {{ $errors->has('coach') ? 'is-invalid' : '' }}" name="coach_id" id="coach_id">
                    @foreach($coaches as $id => $entry)
                        <option value="{{ $id }}" {{ old('coach_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('coach'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coach') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeCoach.fields.coach_helper') }}</span>
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