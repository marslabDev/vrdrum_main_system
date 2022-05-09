@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tuitionGift.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tuition-gifts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.tuitionGift.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\TuitionGift::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tuitionGift.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_minute">{{ trans('cruds.tuitionGift.fields.total_minute') }}</label>
                <input class="form-control {{ $errors->has('total_minute') ? 'is-invalid' : '' }}" type="number" name="total_minute" id="total_minute" value="{{ old('total_minute', '0') }}" step="0.01">
                @if($errors->has('total_minute'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_minute') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tuitionGift.fields.total_minute_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.tuitionGift.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '0') }}" step="0.01">
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tuitionGift.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tuition_package_id">{{ trans('cruds.tuitionGift.fields.tuition_package') }}</label>
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
                <span class="help-block">{{ trans('cruds.tuitionGift.fields.tuition_package_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="inventory_efk">{{ trans('cruds.tuitionGift.fields.inventory_efk') }}</label>
                <input class="form-control {{ $errors->has('inventory_efk') ? 'is-invalid' : '' }}" type="number" name="inventory_efk" id="inventory_efk" value="{{ old('inventory_efk', '') }}" step="1">
                @if($errors->has('inventory_efk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('inventory_efk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tuitionGift.fields.inventory_efk_helper') }}</span>
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