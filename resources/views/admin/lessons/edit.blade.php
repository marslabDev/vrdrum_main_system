@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.lesson.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lessons.update", [$lesson->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="no_of_class">{{ trans('cruds.lesson.fields.no_of_class') }}</label>
                <input class="form-control {{ $errors->has('no_of_class') ? 'is-invalid' : '' }}" type="number" name="no_of_class" id="no_of_class" value="{{ old('no_of_class', $lesson->no_of_class) }}" step="1" required>
                @if($errors->has('no_of_class'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_of_class') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.no_of_class_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.lesson.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $lesson->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="syllabus">{{ trans('cruds.lesson.fields.syllabus') }}</label>
                <input class="form-control {{ $errors->has('syllabus') ? 'is-invalid' : '' }}" type="text" name="syllabus" id="syllabus" value="{{ old('syllabus', $lesson->syllabus) }}">
                @if($errors->has('syllabus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('syllabus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.syllabus_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lesson_level_id">{{ trans('cruds.lesson.fields.lesson_level') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson_level') ? 'is-invalid' : '' }}" name="lesson_level_id" id="lesson_level_id">
                    @foreach($lesson_levels as $id => $entry)
                        <option value="{{ $id }}" {{ (old('lesson_level_id') ? old('lesson_level_id') : $lesson->lesson_level->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson_level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson_level') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.lesson_level_helper') }}</span>
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