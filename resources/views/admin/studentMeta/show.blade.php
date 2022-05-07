@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.studentMetum.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-meta.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.studentMetum.fields.id') }}
                        </th>
                        <td>
                            {{ $studentMetum->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentMetum.fields.meta_key') }}
                        </th>
                        <td>
                            {{ $studentMetum->meta_key }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentMetum.fields.meta_value') }}
                        </th>
                        <td>
                            {{ $studentMetum->meta_value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentMetum.fields.student_efk') }}
                        </th>
                        <td>
                            {{ $studentMetum->student_efk }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-meta.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection