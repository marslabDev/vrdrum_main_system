@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.lessonTimeCoach.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lesson-time-coaches.update", [$lessonTimeCoach->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="lesson_time_id">{{ trans('cruds.lessonTimeCoach.fields.lesson_time') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson_time') ? 'is-invalid' : '' }}" name="lesson_time_id" id="lesson_time_id">
                    @foreach($lesson_times as $id => $entry)
                        <option value="{{ $id }}" {{ (old('lesson_time_id') ? old('lesson_time_id') : $lessonTimeCoach->lesson_time->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <label class="required" for="coach_efk">{{ trans('cruds.lessonTimeCoach.fields.coach_efk') }}</label>
                <input class="form-control {{ $errors->has('coach_efk') ? 'is-invalid' : '' }}" type="number" name="coach_efk" id="coach_efk" value="{{ old('coach_efk', $lessonTimeCoach->coach_efk) }}" step="1" required>
                @if($errors->has('coach_efk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coach_efk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeCoach.fields.coach_efk_helper') }}</span>
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