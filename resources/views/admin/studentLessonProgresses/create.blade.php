@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.studentLessonProgress.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.student-lesson-progresses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="progress">{{ trans('cruds.studentLessonProgress.fields.progress') }}</label>
                <input class="form-control {{ $errors->has('progress') ? 'is-invalid' : '' }}" type="text" name="progress" id="progress" value="{{ old('progress', '') }}" required>
                @if($errors->has('progress'))
                    <div class="invalid-feedback">
                        {{ $errors->first('progress') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentLessonProgress.fields.progress_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lesson_category_id">{{ trans('cruds.studentLessonProgress.fields.lesson_category') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson_category') ? 'is-invalid' : '' }}" name="lesson_category_id" id="lesson_category_id">
                    @foreach($lesson_categories as $id => $entry)
                        <option value="{{ $id }}" {{ old('lesson_category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson_category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson_category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentLessonProgress.fields.lesson_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="student_efk">{{ trans('cruds.studentLessonProgress.fields.student_efk') }}</label>
                <input class="form-control {{ $errors->has('student_efk') ? 'is-invalid' : '' }}" type="number" name="student_efk" id="student_efk" value="{{ old('student_efk', '') }}" step="1" required>
                @if($errors->has('student_efk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student_efk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentLessonProgress.fields.student_efk_helper') }}</span>
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