@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.submitResource.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.submit-resources.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.submitResource.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.submitResource.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="answer_text">{{ trans('cruds.submitResource.fields.answer_text') }}</label>
                <input class="form-control {{ $errors->has('answer_text') ? 'is-invalid' : '' }}" type="text" name="answer_text" id="answer_text" value="{{ old('answer_text', '') }}">
                @if($errors->has('answer_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('answer_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.submitResource.fields.answer_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url">{{ trans('cruds.submitResource.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', '') }}">
                @if($errors->has('url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.submitResource.fields.url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="student_work_id">{{ trans('cruds.submitResource.fields.student_work') }}</label>
                <select class="form-control select2 {{ $errors->has('student_work') ? 'is-invalid' : '' }}" name="student_work_id" id="student_work_id">
                    @foreach($student_works as $id => $entry)
                        <option value="{{ $id }}" {{ old('student_work_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('student_work'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student_work') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.submitResource.fields.student_work_helper') }}</span>
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