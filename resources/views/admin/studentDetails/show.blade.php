@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.studentDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $studentDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.full_name') }}
                        </th>
                        <td>
                            {{ $studentDetail->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.parent_name') }}
                        </th>
                        <td>
                            {{ $studentDetail->parent_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.parent_phone') }}
                        </th>
                        <td>
                            {{ $studentDetail->parent_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.group') }}
                        </th>
                        <td>
                            {{ $studentDetail->group }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.is_disabled') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $studentDetail->is_disabled ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.student_efk') }}
                        </th>
                        <td>
                            {{ $studentDetail->student_efk }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection