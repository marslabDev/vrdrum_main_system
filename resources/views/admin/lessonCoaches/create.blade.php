@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.lessonCoach.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lesson-coaches.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="lesson_id">{{ trans('cruds.lessonCoach.fields.lesson') }}</label>
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
                <span class="help-block">{{ trans('cruds.lessonCoach.fields.lesson_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="coach_id">{{ trans('cruds.lessonCoach.fields.coach') }}</label>
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
                <span class="help-block">{{ trans('cruds.lessonCoach.fields.coach_helper') }}</span>
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