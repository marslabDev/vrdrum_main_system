@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.lessonTimePost.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lesson-time-posts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimePost.fields.id') }}
                        </th>
                        <td>
                            {{ $lessonTimePost->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimePost.fields.group') }}
                        </th>
                        <td>
                            {{ $lessonTimePost->group }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimePost.fields.category') }}
                        </th>
                        <td>
                            {{ App\Models\LessonTimePost::CATEGORY_SELECT[$lessonTimePost->category] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimePost.fields.title') }}
                        </th>
                        <td>
                            {{ $lessonTimePost->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimePost.fields.desc') }}
                        </th>
                        <td>
                            {!! $lessonTimePost->desc !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimePost.fields.publish_at') }}
                        </th>
                        <td>
                            {{ $lessonTimePost->publish_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimePost.fields.terminate_at') }}
                        </th>
                        <td>
                            {{ $lessonTimePost->terminate_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimePost.fields.start_at') }}
                        </th>
                        <td>
                            {{ $lessonTimePost->start_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimePost.fields.end_at') }}
                        </th>
                        <td>
                            {{ $lessonTimePost->end_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimePost.fields.required_response') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $lessonTimePost->required_response ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimePost.fields.lesson_time') }}
                        </th>
                        <td>
                            {{ $lessonTimePost->lesson_time->lesson_code ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lesson-time-posts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection