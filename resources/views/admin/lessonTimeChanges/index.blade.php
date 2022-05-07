@extends('layouts.admin')
@section('content')
@can('lesson_time_change_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.lesson-time-changes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.lessonTimeChange.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.lessonTimeChange.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-LessonTimeChange">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.old_lesson_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.date_from') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.date_to') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.class_room') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.lesson') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.student') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.request_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.request_user') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.response_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.response_user') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lessonTimeChanges as $key => $lessonTimeChange)
                        <tr data-entry-id="{{ $lessonTimeChange->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $lessonTimeChange->id ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTimeChange->old_lesson_time->lesson_code ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTimeChange->date_from ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTimeChange->date_to ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTimeChange->class_room->room_title ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTimeChange->lesson->name ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTimeChange->student->name ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTimeChange->status ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTimeChange->request_date ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTimeChange->request_user->name ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTimeChange->response_date ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTimeChange->response_user->name ?? '' }}
                            </td>
                            <td>
                                @can('lesson_time_change_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.lesson-time-changes.show', $lessonTimeChange->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('lesson_time_change_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.lesson-time-changes.edit', $lessonTimeChange->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('lesson_time_change_delete')
                                    <form action="{{ route('admin.lesson-time-changes.destroy', $lessonTimeChange->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('lesson_time_change_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.lesson-time-changes.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-LessonTimeChange:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection