@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.studentLessonProgress.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.student-lesson-progresses.update", [$studentLessonProgress->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="progress">{{ trans('cruds.studentLessonProgress.fields.progress') }}</label>
                <input class="form-control {{ $errors->has('progress') ? 'is-invalid' : '' }}" type="text" name="progress" id="progress" value="{{ old('progress', $studentLessonProgress->progress) }}" required>
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
                        <option value="{{ $id }}" {{ (old('lesson_category_id') ? old('lesson_category_id') : $studentLessonProgress->lesson_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <label for="student_id">{{ trans('cruds.studentLessonProgress.fields.student') }}</label>
                <select class="form-control select2 {{ $errors->has('student') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                    @foreach($students as $id => $entry)
                        <option value="{{ $id }}" {{ (old('student_id') ? old('student_id') : $studentLessonProgress->student->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('student'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentLessonProgress.fields.student_helper') }}</span>
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