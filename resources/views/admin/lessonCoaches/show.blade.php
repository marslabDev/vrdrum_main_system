@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.lessonCoach.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lesson-coaches.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonCoach.fields.id') }}
                        </th>
                        <td>
                            {{ $lessonCoach->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonCoach.fields.lesson') }}
                        </th>
                        <td>
                            {{ $lessonCoach->lesson->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonCoach.fields.coach') }}
                        </th>
                        <td>
                            {{ $lessonCoach->coach->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lesson-coaches.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection