@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.lessonCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lesson-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $lessonCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonCategory.fields.name') }}
                        </th>
                        <td>
                            {{ $lessonCategory->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonCategory.fields.desc') }}
                        </th>
                        <td>
                            {{ $lessonCategory->desc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonCategory.fields.group') }}
                        </th>
                        <td>
                            {{ App\Models\LessonCategory::GROUP_SELECT[$lessonCategory->group] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lesson-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection