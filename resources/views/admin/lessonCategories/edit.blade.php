@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.lessonCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lesson-categories.update", [$lessonCategory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.lessonCategory.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $lessonCategory->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonCategory.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="desc">{{ trans('cruds.lessonCategory.fields.desc') }}</label>
                <input class="form-control {{ $errors->has('desc') ? 'is-invalid' : '' }}" type="text" name="desc" id="desc" value="{{ old('desc', $lessonCategory->desc) }}">
                @if($errors->has('desc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('desc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonCategory.fields.desc_helper') }}</span>
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