@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.studentTuition.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.student-tuitions.update", [$studentTuition->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="tuition_package_id">{{ trans('cruds.studentTuition.fields.tuition_package') }}</label>
                <select class="form-control select2 {{ $errors->has('tuition_package') ? 'is-invalid' : '' }}" name="tuition_package_id" id="tuition_package_id" required>
                    @foreach($tuition_packages as $id => $entry)
                        <option value="{{ $id }}" {{ (old('tuition_package_id') ? old('tuition_package_id') : $studentTuition->tuition_package->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <label class="required" for="student_efk">{{ trans('cruds.studentTuition.fields.student_efk') }}</label>
                <input class="form-control {{ $errors->has('student_efk') ? 'is-invalid' : '' }}" type="number" name="student_efk" id="student_efk" value="{{ old('student_efk', $studentTuition->student_efk) }}" step="1" required>
                @if($errors->has('student_efk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student_efk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentTuition.fields.student_efk_helper') }}</span>
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