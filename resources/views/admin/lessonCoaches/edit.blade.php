@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.lessonCoach.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lesson-coaches.update", [$lessonCoach->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="lesson_id">{{ trans('cruds.lessonCoach.fields.lesson') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson') ? 'is-invalid' : '' }}" name="lesson_id" id="lesson_id">
                    @foreach($lessons as $id => $entry)
                        <option value="{{ $id }}" {{ (old('lesson_id') ? old('lesson_id') : $lessonCoach->lesson->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonCoach.fields.lesson_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="coach_efk">{{ trans('cruds.lessonCoach.fields.coach_efk') }}</label>
                <input class="form-control {{ $errors->has('coach_efk') ? 'is-invalid' : '' }}" type="number" name="coach_efk" id="coach_efk" value="{{ old('coach_efk', $lessonCoach->coach_efk) }}" step="1" required>
                @if($errors->has('coach_efk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coach_efk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonCoach.fields.coach_efk_helper') }}</span>
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