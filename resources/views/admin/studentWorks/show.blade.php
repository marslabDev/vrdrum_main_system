@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.studentWork.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-works.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.studentWork.fields.id') }}
                        </th>
                        <td>
                            {{ $studentWork->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentWork.fields.category') }}
                        </th>
                        <td>
                            {{ App\Models\StudentWork::CATEGORY_SELECT[$studentWork->category] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentWork.fields.title') }}
                        </th>
                        <td>
                            {{ $studentWork->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentWork.fields.desc') }}
                        </th>
                        <td>
                            {{ $studentWork->desc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentWork.fields.start_at') }}
                        </th>
                        <td>
                            {{ $studentWork->start_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentWork.fields.end_at') }}
                        </th>
                        <td>
                            {{ $studentWork->end_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentWork.fields.time_given_minute') }}
                        </th>
                        <td>
                            {{ $studentWork->time_given_minute }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentWork.fields.lesson_time') }}
                        </th>
                        <td>
                            {{ $studentWork->lesson_time->lesson_code ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-works.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection