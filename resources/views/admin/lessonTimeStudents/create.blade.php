@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.lessonTimeStudent.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lesson-time-students.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="attended_at">{{ trans('cruds.lessonTimeStudent.fields.attended_at') }}</label>
                <input class="form-control datetime {{ $errors->has('attended_at') ? 'is-invalid' : '' }}" type="text" name="attended_at" id="attended_at" value="{{ old('attended_at') }}">
                @if($errors->has('attended_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attended_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeStudent.fields.attended_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="leave_at">{{ trans('cruds.lessonTimeStudent.fields.leave_at') }}</label>
                <input class="form-control datetime {{ $errors->has('leave_at') ? 'is-invalid' : '' }}" type="text" name="leave_at" id="leave_at" value="{{ old('leave_at') }}">
                @if($errors->has('leave_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('leave_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeStudent.fields.leave_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cancel_at">{{ trans('cruds.lessonTimeStudent.fields.cancel_at') }}</label>
                <input class="form-control datetime {{ $errors->has('cancel_at') ? 'is-invalid' : '' }}" type="text" name="cancel_at" id="cancel_at" value="{{ old('cancel_at') }}">
                @if($errors->has('cancel_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cancel_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeStudent.fields.cancel_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lesson_time_id">{{ trans('cruds.lessonTimeStudent.fields.lesson_time') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson_time') ? 'is-invalid' : '' }}" name="lesson_time_id" id="lesson_time_id">
                    @foreach($lesson_times as $id => $entry)
                        <option value="{{ $id }}" {{ old('lesson_time_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeStudent.fields.lesson_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="student_efk">{{ trans('cruds.lessonTimeStudent.fields.student_efk') }}</label>
                <input class="form-control {{ $errors->has('student_efk') ? 'is-invalid' : '' }}" type="number" name="student_efk" id="student_efk" value="{{ old('student_efk', '') }}" step="1" required>
                @if($errors->has('student_efk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student_efk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimeStudent.fields.student_efk_helper') }}</span>
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