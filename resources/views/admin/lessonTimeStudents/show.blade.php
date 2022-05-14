@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.lessonTimeStudent.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lesson-time-students.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeStudent.fields.id') }}
                        </th>
                        <td>
                            {{ $lessonTimeStudent->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeStudent.fields.attended_at') }}
                        </th>
                        <td>
                            {{ $lessonTimeStudent->attended_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeStudent.fields.leave_at') }}
                        </th>
                        <td>
                            {{ $lessonTimeStudent->leave_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeStudent.fields.cancel_at') }}
                        </th>
                        <td>
                            {{ $lessonTimeStudent->cancel_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeStudent.fields.lesson_time') }}
                        </th>
                        <td>
                            {{ $lessonTimeStudent->lesson_time->lesson_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeStudent.fields.student_efk') }}
                        </th>
                        <td>
                            {{ $lessonTimeStudent->student_efk }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lesson-time-students.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection