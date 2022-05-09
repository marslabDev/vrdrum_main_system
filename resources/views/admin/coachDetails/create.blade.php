@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.coachDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.coach-details.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.coachDetail.fields.enrollment_status') }}</label>
                <select class="form-control {{ $errors->has('enrollment_status') ? 'is-invalid' : '' }}" name="enrollment_status" id="enrollment_status" required>
                    <option value disabled {{ old('enrollment_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CoachDetail::ENROLLMENT_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('enrollment_status', 'full_time') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('enrollment_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('enrollment_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coachDetail.fields.enrollment_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="coach_efk">{{ trans('cruds.coachDetail.fields.coach_efk') }}</label>
                <input class="form-control {{ $errors->has('coach_efk') ? 'is-invalid' : '' }}" type="number" name="coach_efk" id="coach_efk" value="{{ old('coach_efk', '') }}" step="1" required>
                @if($errors->has('coach_efk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coach_efk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coachDetail.fields.coach_efk_helper') }}</span>
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