@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.workResource.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.work-resources.update", [$workResource->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.workResource.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $workResource->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workResource.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="question_text">{{ trans('cruds.workResource.fields.question_text') }}</label>
                <input class="form-control {{ $errors->has('question_text') ? 'is-invalid' : '' }}" type="text" name="question_text" id="question_text" value="{{ old('question_text', $workResource->question_text) }}">
                @if($errors->has('question_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workResource.fields.question_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url">{{ trans('cruds.workResource.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', $workResource->url) }}">
                @if($errors->has('url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workResource.fields.url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="student_work_id">{{ trans('cruds.workResource.fields.student_work') }}</label>
                <select class="form-control select2 {{ $errors->has('student_work') ? 'is-invalid' : '' }}" name="student_work_id" id="student_work_id">
                    @foreach($student_works as $id => $entry)
                        <option value="{{ $id }}" {{ (old('student_work_id') ? old('student_work_id') : $workResource->student_work->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('student_work'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student_work') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workResource.fields.student_work_helper') }}</span>
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