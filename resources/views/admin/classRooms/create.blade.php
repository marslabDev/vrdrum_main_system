@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.classRoom.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.class-rooms.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="room_title">{{ trans('cruds.classRoom.fields.room_title') }}</label>
                <input class="form-control {{ $errors->has('room_title') ? 'is-invalid' : '' }}" type="text" name="room_title" id="room_title" value="{{ old('room_title', '') }}" required>
                @if($errors->has('room_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('room_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.classRoom.fields.room_title_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_available') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_available" id="is_available" value="1" required {{ old('is_available', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="is_available">{{ trans('cruds.classRoom.fields.is_available') }}</label>
                </div>
                @if($errors->has('is_available'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_available') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.classRoom.fields.is_available_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="branch_id">{{ trans('cruds.classRoom.fields.branch') }}</label>
                <select class="form-control select2 {{ $errors->has('branch') ? 'is-invalid' : '' }}" name="branch_id" id="branch_id">
                    @foreach($branches as $id => $entry)
                        <option value="{{ $id }}" {{ old('branch_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('branch'))
                    <div class="invalid-feedback">
                        {{ $errors->first('branch') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.classRoom.fields.branch_helper') }}</span>
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