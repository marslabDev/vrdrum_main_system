@extends('layouts.admin')
@section('content')
@can('lesson_time_change_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.lesson-time-changes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.lessonTimeChange.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'LessonTimeChange', 'route' => 'admin.lesson-time-changes.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.lessonTimeChange.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-LessonTimeChange">
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
                        {{ trans('cruds.lessonTimeChange.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.lessonTimeChange.fields.request_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.lessonTimeChange.fields.request_user_efk') }}
                    </th>
                    <th>
                        {{ trans('cruds.lessonTimeChange.fields.response_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.lessonTimeChange.fields.response_user_efk') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('lesson_time_change_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.lesson-time-changes.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.lesson-time-changes.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'old_lesson_time_lesson_code', name: 'old_lesson_time.lesson_code' },
{ data: 'date_from', name: 'date_from' },
{ data: 'date_to', name: 'date_to' },
{ data: 'class_room_room_title', name: 'class_room.room_title' },
{ data: 'lesson_name', name: 'lesson.name' },
{ data: 'status', name: 'status' },
{ data: 'request_date', name: 'request_date' },
{ data: 'request_user_efk', name: 'request_user_efk' },
{ data: 'response_date', name: 'response_date' },
{ data: 'response_user_efk', name: 'response_user_efk' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-LessonTimeChange').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection