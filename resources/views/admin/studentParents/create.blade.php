@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.studentParent.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.student-parents.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.studentParent.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentParent.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nationality">{{ trans('cruds.studentParent.fields.nationality') }}</label>
                <input class="form-control {{ $errors->has('nationality') ? 'is-invalid' : '' }}" type="text" name="nationality" id="nationality" value="{{ old('nationality', '') }}">
                @if($errors->has('nationality'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nationality') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentParent.fields.nationality_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.studentParent.fields.relationship') }}</label>
                <select class="form-control {{ $errors->has('relationship') ? 'is-invalid' : '' }}" name="relationship" id="relationship" required>
                    <option value disabled {{ old('relationship', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\StudentParent::RELATIONSHIP_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('relationship', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('relationship'))
                    <div class="invalid-feedback">
                        {{ $errors->first('relationship') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentParent.fields.relationship_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.studentParent.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}">
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentParent.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nric_no">{{ trans('cruds.studentParent.fields.nric_no') }}</label>
                <input class="form-control {{ $errors->has('nric_no') ? 'is-invalid' : '' }}" type="number" name="nric_no" id="nric_no" value="{{ old('nric_no', '') }}" step="1">
                @if($errors->has('nric_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nric_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentParent.fields.nric_no_helper') }}</span>
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