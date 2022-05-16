@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.lessonLevel.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lesson-levels.update", [$lessonLevel->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="lesson_category_id">{{ trans('cruds.lessonLevel.fields.lesson_category') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson_category') ? 'is-invalid' : '' }}" name="lesson_category_id" id="lesson_category_id" required>
                    @foreach($lesson_categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('lesson_category_id') ? old('lesson_category_id') : $lessonLevel->lesson_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson_category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson_category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonLevel.fields.lesson_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="level">{{ trans('cruds.lessonLevel.fields.level') }}</label>
                <input class="form-control {{ $errors->has('level') ? 'is-invalid' : '' }}" type="number" name="level" id="level" value="{{ old('level', $lessonLevel->level) }}" step="1" required>
                @if($errors->has('level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('level') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonLevel.fields.level_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.lessonLevel.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $lessonLevel->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonLevel.fields.name_helper') }}</span>
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