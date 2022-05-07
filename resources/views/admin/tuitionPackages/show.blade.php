@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tuitionPackage.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tuition-packages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tuitionPackage.fields.id') }}
                        </th>
                        <td>
                            {{ $tuitionPackage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tuitionPackage.fields.name') }}
                        </th>
                        <td>
                            {{ $tuitionPackage->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tuitionPackage.fields.price') }}
                        </th>
                        <td>
                            {{ $tuitionPackage->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tuitionPackage.fields.total_minute') }}
                        </th>
                        <td>
                            {{ $tuitionPackage->total_minute }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tuitionPackage.fields.lesson_category') }}
                        </th>
                        <td>
                            {{ $tuitionPackage->lesson_category->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tuition-packages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection