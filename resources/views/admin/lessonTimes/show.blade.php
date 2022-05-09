@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.lessonTime.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lesson-times.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTime.fields.id') }}
                        </th>
                        <td>
                            {{ $lessonTime->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTime.fields.lesson_code') }}
                        </th>
                        <td>
                            {{ $lessonTime->lesson_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTime.fields.date_from') }}
                        </th>
                        <td>
                            {{ $lessonTime->date_from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTime.fields.date_to') }}
                        </th>
                        <td>
                            {{ $lessonTime->date_to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTime.fields.attended_at') }}
                        </th>
                        <td>
                            {{ $lessonTime->attended_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTime.fields.leaved_at') }}
                        </th>
                        <td>
                            {{ $lessonTime->leaved_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTime.fields.class_room') }}
                        </th>
                        <td>
                            {{ $lessonTime->class_room->room_title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTime.fields.lesson') }}
                        </th>
                        <td>
                            {{ $lessonTime->lesson->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTime.fields.student_efk') }}
                        </th>
                        <td>
                            {{ $lessonTime->student_efk }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lesson-times.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection