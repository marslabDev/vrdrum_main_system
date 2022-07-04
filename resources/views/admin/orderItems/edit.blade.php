@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.orderItem.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.order-items.update", [$orderItem->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.orderItem.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $orderItem->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_qty">{{ trans('cruds.orderItem.fields.product_qty') }}</label>
                <input class="form-control {{ $errors->has('product_qty') ? 'is-invalid' : '' }}" type="number" name="product_qty" id="product_qty" value="{{ old('product_qty', $orderItem->product_qty) }}" step="0.01" min="1">
                @if($errors->has('product_qty'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_qty') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.product_qty_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="net_total">{{ trans('cruds.orderItem.fields.net_total') }}</label>
                <input class="form-control {{ $errors->has('net_total') ? 'is-invalid' : '' }}" type="number" name="net_total" id="net_total" value="{{ old('net_total', $orderItem->net_total) }}" step="0.01" required>
                @if($errors->has('net_total'))
                    <div class="invalid-feedback">
                        {{ $errors->first('net_total') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.net_total_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total">{{ trans('cruds.orderItem.fields.total') }}</label>
                <input class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}" type="number" name="total" id="total" value="{{ old('total', $orderItem->total) }}" step="0.01" required>
                @if($errors->has('total'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.total_helper') }}</span>
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