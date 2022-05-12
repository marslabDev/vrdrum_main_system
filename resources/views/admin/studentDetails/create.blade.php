@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.studentDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action='{{ route("admin.student-details.store") }}' enctype="multipart/form-data">
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
                <label for="parent_name">{{ trans('cruds.studentDetail.fields.parent_name') }}</label>
                <input class="form-control {{ $errors->has('parent_name') ? 'is-invalid' : '' }}" type="text" name="parent_name" id="parent_name" value="{{ old('parent_name', '') }}">
                @if($errors->has('parent_name'))
                <div class="invalid-feedback">
                    {{ $errors->first('parent_name') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.parent_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="parent_phone">{{ trans('cruds.studentDetail.fields.parent_phone') }}</label>
                <input class="form-control {{ $errors->has('parent_phone') ? 'is-invalid' : '' }}" 
                type="tel" name="parent_phone" id="parent_phone" value="{{ old('parent_phone', '') }}"
                pattern="{{ Config::get('constants.phone_number_pattern') }}"
                title='{{ trans("validation.follow_phone_number_format") }}'>
                @if($errors->has('parent_phone'))
                <div class="invalid-feedback">
                    {{ $errors->first('parent_phone') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.parent_phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lesson_categories">{{ trans('cruds.studentDetail.fields.lesson_categories') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson_category') ? 'is-invalid' : '' }}" name="lesson_categories[]" id="lesson_categories" required>
                    @foreach($lessonCategories as $id => $lessonCategory)
                        <option value="{{ $id }}" {{ in_array($id, old('lessonCategory', [])) ? 'selected' : '' }}>{{ $lessonCategory }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson_categories'))
                <div class="invalid-feedback">
                    {{ $errors->first('lesson_categories') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.lesson_categories_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lesson_group">{{ trans('cruds.studentDetail.fields.lesson_group') }}</label>
                <!-- <input class="form-control {{ $errors->has('group') ? 'is-invalid' : '' }}" type="text" name="group" id="group" value="{{ old('group', '') }}" required> -->
                <select class="form-control select2 {{ $errors->has('lesson_group') ? 'is-invalid' : '' }}" name="lesson_group" id="lesson_group" required>
                    @foreach($lessonCategories as $id => $lessonGroup)
                        <option value="{{ $id }}" {{ in_array($id, old('lessonGroup', [])) ? 'selected' : '' }}>{{ $lessonGroup }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson_group'))
                <div class="invalid-feedback">
                    {{ $errors->first('lesson_group') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.lesson_group_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_disabled') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_disabled" id="is_disabled" value="{{ old('is_disabled', 0) }}" {{ old('is_disabled', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_disabled">{{ trans('cruds.studentDetail.fields.is_disabled') }}</label>
                </div>
                @if($errors->has('is_disabled'))
                <div class="invalid-feedback">
                    {{ $errors->first('is_disabled') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.is_disabled_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>
            <!--
            <div class="form-group">
                <label class="required" for="student_efk">{{ trans('cruds.studentDetail.fields.student_efk') }}</label>
                <input class="form-control {{ $errors->has('student_efk') ? 'is-invalid' : '' }}" type="number" name="student_efk" id="student_efk" value="{{ old('student_efk', '') }}" step="1" required>
                @if($errors->has('student_efk'))
                <div class="invalid-feedback">
                    {{ $errors->first('student_efk') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentDetail.fields.student_efk_helper') }}</span>
            </div>
            -->
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection