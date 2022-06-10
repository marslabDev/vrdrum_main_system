@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.studentDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.student-details.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="full_name">{{ trans('cruds.studentDetail.fields.full_name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', '') }}" required>
                @if($errors->has('full_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('full_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_handicapped') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_handicapped" value="0">
                    <input class="form-check-input" type="checkbox" name="is_handicapped" id="is_handicapped" value="1" {{ old('is_handicapped', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_handicapped">{{ trans('cruds.studentDetail.fields.is_handicapped') }}</label>
                </div>
                @if($errors->has('is_handicapped'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_handicapped') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.is_handicapped_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.studentDetail.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\StudentDetail::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="country">{{ trans('cruds.studentDetail.fields.country') }}</label>
                <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', '') }}">
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="home_address">{{ trans('cruds.studentDetail.fields.home_address') }}</label>
                <input class="form-control {{ $errors->has('home_address') ? 'is-invalid' : '' }}" type="text" name="home_address" id="home_address" value="{{ old('home_address', '') }}">
                @if($errors->has('home_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('home_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.home_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mail_address">{{ trans('cruds.studentDetail.fields.mail_address') }}</label>
                <input class="form-control {{ $errors->has('mail_address') ? 'is-invalid' : '' }}" type="text" name="mail_address" id="mail_address" value="{{ old('mail_address', '') }}" required>
                @if($errors->has('mail_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mail_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.mail_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="state">{{ trans('cruds.studentDetail.fields.state') }}</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', '') }}">
                @if($errors->has('state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.studentDetail.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}">
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="postcode">{{ trans('cruds.studentDetail.fields.postcode') }}</label>
                <input class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" type="number" name="postcode" id="postcode" value="{{ old('postcode', '') }}" step="1">
                @if($errors->has('postcode'))
                    <div class="invalid-feedback">
                        {{ $errors->first('postcode') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.postcode_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.studentDetail.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nric_no">{{ trans('cruds.studentDetail.fields.nric_no') }}</label>
                <input class="form-control {{ $errors->has('nric_no') ? 'is-invalid' : '' }}" type="number" name="nric_no" id="nric_no" value="{{ old('nric_no', '') }}" step="1">
                @if($errors->has('nric_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nric_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.nric_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.studentDetail.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="guardians">{{ trans('cruds.studentDetail.fields.guardian') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('guardians') ? 'is-invalid' : '' }}" name="guardians[]" id="guardians" multiple>
                    @foreach($guardians as $id => $guardian)
                        <option value="{{ $id }}" {{ in_array($id, old('guardians', [])) ? 'selected' : '' }}>{{ $guardian }}</option>
                    @endforeach
                </select>
                @if($errors->has('guardians'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guardians') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.guardian_helper') }}</span>
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