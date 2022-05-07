@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tuitionPackage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tuition-packages.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.tuitionPackage.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tuitionPackage.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_lesson">{{ trans('cruds.tuitionPackage.fields.total_lesson') }}</label>
                <input class="form-control {{ $errors->has('total_lesson') ? 'is-invalid' : '' }}" type="number" name="total_lesson" id="total_lesson" value="{{ old('total_lesson', '0') }}" step="0.01" required>
                @if($errors->has('total_lesson'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_lesson') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tuitionPackage.fields.total_lesson_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lesson_category_id">{{ trans('cruds.tuitionPackage.fields.lesson_category') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson_category') ? 'is-invalid' : '' }}" name="lesson_category_id" id="lesson_category_id" required>
                    @foreach($lesson_categories as $id => $entry)
                        <option value="{{ $id }}" {{ old('lesson_category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson_category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson_category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tuitionPackage.fields.lesson_category_helper') }}</span>
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