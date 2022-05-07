@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.studentTuition.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-tuitions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.studentTuition.fields.id') }}
                        </th>
                        <td>
                            {{ $studentTuition->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentTuition.fields.lesson_left') }}
                        </th>
                        <td>
                            {{ $studentTuition->lesson_left }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentTuition.fields.tuition_package') }}
                        </th>
                        <td>
                            {{ $studentTuition->tuition_package->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentTuition.fields.student_efk') }}
                        </th>
                        <td>
                            {{ $studentTuition->student_efk }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-tuitions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection