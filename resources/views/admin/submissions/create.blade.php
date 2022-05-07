@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.submission.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.submissions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>{{ trans('cruds.submission.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Submission::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'IN_REVIEW') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.submission.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="submit_at">{{ trans('cruds.submission.fields.submit_at') }}</label>
                <input class="form-control datetime {{ $errors->has('submit_at') ? 'is-invalid' : '' }}" type="text" name="submit_at" id="submit_at" value="{{ old('submit_at') }}">
                @if($errors->has('submit_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('submit_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.submission.fields.submit_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mark">{{ trans('cruds.submission.fields.mark') }}</label>
                <input class="form-control {{ $errors->has('mark') ? 'is-invalid' : '' }}" type="number" name="mark" id="mark" value="{{ old('mark', '') }}" step="0.01">
                @if($errors->has('mark'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mark') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.submission.fields.mark_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mark_at">{{ trans('cruds.submission.fields.mark_at') }}</label>
                <input class="form-control datetime {{ $errors->has('mark_at') ? 'is-invalid' : '' }}" type="text" name="mark_at" id="mark_at" value="{{ old('mark_at') }}">
                @if($errors->has('mark_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mark_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.submission.fields.mark_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="student_work_id">{{ trans('cruds.submission.fields.student_work') }}</label>
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
                <span class="help-block">{{ trans('cruds.submission.fields.student_work_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="student_id">{{ trans('cruds.submission.fields.student') }}</label>
                <select class="form-control select2 {{ $errors->has('student') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                    @foreach($students as $id => $entry)
                        <option value="{{ $id }}" {{ old('student_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('student'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.submission.fields.student_helper') }}</span>
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