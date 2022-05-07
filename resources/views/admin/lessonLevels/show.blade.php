@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.lessonLevel.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lesson-levels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonLevel.fields.id') }}
                        </th>
                        <td>
                            {{ $lessonLevel->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonLevel.fields.level') }}
                        </th>
                        <td>
                            {{ $lessonLevel->level }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonLevel.fields.name') }}
                        </th>
                        <td>
                            {{ $lessonLevel->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonLevel.fields.lesson_category') }}
                        </th>
                        <td>
                            {{ $lessonLevel->lesson_category->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lesson-levels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection