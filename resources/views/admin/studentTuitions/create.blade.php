@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.studentTuition.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.student-tuitions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="minute_left">{{ trans('cruds.studentTuition.fields.minute_left') }}</label>
                <input class="form-control {{ $errors->has('minute_left') ? 'is-invalid' : '' }}" type="number" name="minute_left" id="minute_left" value="{{ old('minute_left', '0') }}" step="0.01" required>
                @if($errors->has('minute_left'))
                    <div class="invalid-feedback">
                        {{ $errors->first('minute_left') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentTuition.fields.minute_left_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tuition_package_id">{{ trans('cruds.studentTuition.fields.tuition_package') }}</label>
                <select class="form-control select2 {{ $errors->has('tuition_package') ? 'is-invalid' : '' }}" name="tuition_package_id" id="tuition_package_id">
                    @foreach($tuition_packages as $id => $entry)
                        <option value="{{ $id }}" {{ old('tuition_package_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('tuition_package'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tuition_package') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentTuition.fields.tuition_package_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="student_id">{{ trans('cruds.studentTuition.fields.student') }}</label>
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
                <span class="help-block">{{ trans('cruds.studentTuition.fields.student_helper') }}</span>
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