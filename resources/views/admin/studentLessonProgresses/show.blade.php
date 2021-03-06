@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.studentLessonProgress.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-lesson-progresses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.studentLessonProgress.fields.id') }}
                        </th>
                        <td>
                            {{ $studentLessonProgress->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentLessonProgress.fields.progress') }}
                        </th>
                        <td>
                            {{ $studentLessonProgress->progress }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentLessonProgress.fields.lesson_category') }}
                        </th>
                        <td>
                            {{ $studentLessonProgress->lesson_category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentLessonProgress.fields.student_efk') }}
                        </th>
                        <td>
                            {{ $studentLessonProgress->student_efk }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-lesson-progresses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection