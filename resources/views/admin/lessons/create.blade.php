@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.lesson.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lessons.store") }}" enctype="multipart/form-data">
            @csrf
            <!-- <div class="form-group">
                <label for="no_of_class">{{ trans('cruds.lesson.fields.no_of_class') }}</label>
                <input class="form-control {{ $errors->has('no_of_class') ? 'is-invalid' : '' }}" type="number" name="no_of_class" id="no_of_class" value="{{ old('no_of_class', '1') }}" step="1" disabled>
            </div> -->
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.lesson.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="syllabus">{{ trans('cruds.lesson.fields.syllabus') }}</label>
                <input class="form-control {{ $errors->has('syllabus') ? 'is-invalid' : '' }}" type="text" name="syllabus" id="syllabus" value="{{ old('syllabus', '') }}">
                @if($errors->has('syllabus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('syllabus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.syllabus_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lesson_level_id">{{ trans('cruds.lesson.fields.lesson_level') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson_level') ? 'is-invalid' : '' }}" name="lesson_level_id" id="lesson_level_id" required>
                    @foreach($lesson_levels as $id => $entry)
                        <option value="{{ $id }}" {{ old('lesson_level_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <label for="coachs_efk[]">{{ trans('cruds.lessonCoach.fields.coach_efk') }}</label>
                <select class="form-control select2 {{ $errors->has('coachs_efk[]') ? 'is-invalid' : '' }}" name="coachs_efk[]" id="coachs_efk[]" multiple="multiple">
                    @foreach($coachs as $id => $entry)
                        <option value="{{ $id }}" {{ old('coachs_efk[]') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('coachs_efk[]'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coachs_efk[]') }}
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