@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.postSubmission.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.post-submissions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="status">{{ trans('cruds.postSubmission.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', '') }}" required>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postSubmission.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="submit_at">{{ trans('cruds.postSubmission.fields.submit_at') }}</label>
                <input class="form-control datetime {{ $errors->has('submit_at') ? 'is-invalid' : '' }}" type="text" name="submit_at" id="submit_at" value="{{ old('submit_at') }}">
                @if($errors->has('submit_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('submit_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postSubmission.fields.submit_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mark">{{ trans('cruds.postSubmission.fields.mark') }}</label>
                <input class="form-control {{ $errors->has('mark') ? 'is-invalid' : '' }}" type="number" name="mark" id="mark" value="{{ old('mark', '') }}" step="0.01">
                @if($errors->has('mark'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mark') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postSubmission.fields.mark_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mark_at">{{ trans('cruds.postSubmission.fields.mark_at') }}</label>
                <input class="form-control datetime {{ $errors->has('mark_at') ? 'is-invalid' : '' }}" type="text" name="mark_at" id="mark_at" value="{{ old('mark_at') }}">
                @if($errors->has('mark_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mark_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postSubmission.fields.mark_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lesson_time_post_id">{{ trans('cruds.postSubmission.fields.lesson_time_post') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson_time_post') ? 'is-invalid' : '' }}" name="lesson_time_post_id" id="lesson_time_post_id" required>
                    @foreach($lesson_time_posts as $id => $entry)
                        <option value="{{ $id }}" {{ old('lesson_time_post_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson_time_post'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson_time_post') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postSubmission.fields.lesson_time_post_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="student_efk">{{ trans('cruds.postSubmission.fields.student_efk') }}</label>
                <input class="form-control {{ $errors->has('student_efk') ? 'is-invalid' : '' }}" type="number" name="student_efk" id="student_efk" value="{{ old('student_efk', '') }}" step="1" required>
                @if($errors->has('student_efk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student_efk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postSubmission.fields.student_efk_helper') }}</span>
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