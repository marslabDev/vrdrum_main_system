@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tuitionPackage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tuition-packages.update", [$tuitionPackage->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.tuitionPackage.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $tuitionPackage->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tuitionPackage.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.tuitionPackage.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $tuitionPackage->price) }}" step="0.01" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tuitionPackage.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_minute">{{ trans('cruds.tuitionPackage.fields.total_minute') }}</label>
                <input class="form-control {{ $errors->has('total_minute') ? 'is-invalid' : '' }}" type="number" name="total_minute" id="total_minute" value="{{ old('total_minute', $tuitionPackage->total_minute) }}" step="0.01" required>
                @if($errors->has('total_minute'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_minute') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tuitionPackage.fields.total_minute_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lesson_category_id">{{ trans('cruds.tuitionPackage.fields.lesson_category') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson_category') ? 'is-invalid' : '' }}" name="lesson_category_id" id="lesson_category_id">
                    @foreach($lesson_categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('lesson_category_id') ? old('lesson_category_id') : $tuitionPackage->lesson_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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