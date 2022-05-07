@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tuitionGift.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tuition-gifts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tuitionGift.fields.id') }}
                        </th>
                        <td>
                            {{ $tuitionGift->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tuitionGift.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\TuitionGift::TYPE_SELECT[$tuitionGift->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tuitionGift.fields.total_lesson') }}
                        </th>
                        <td>
                            {{ $tuitionGift->total_lesson }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tuitionGift.fields.quantity') }}
                        </th>
                        <td>
                            {{ $tuitionGift->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tuitionGift.fields.tuition_package') }}
                        </th>
                        <td>
                            {{ $tuitionGift->tuition_package->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tuitionGift.fields.inventory_efk') }}
                        </th>
                        <td>
                            {{ $tuitionGift->inventory_efk }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tuition-gifts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection