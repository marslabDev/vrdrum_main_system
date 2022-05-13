@extends('layouts.admin')
@section('content')
@can('student_work_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.student-works.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.studentWork.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'StudentWork', 'route' => 'admin.student-works.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.studentWork.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-StudentWork">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.studentWork.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.studentWork.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.studentWork.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.studentWork.fields.desc') }}
                    </th>
                    <th>
                        {{ trans('cruds.studentWork.fields.start_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.studentWork.fields.end_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.studentWork.fields.time_given_minute') }}
                    </th>
                    <th>
                        {{ trans('cruds.studentWork.fields.lesson_time') }}
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
@can('student_work_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.student-works.massDestroy') }}",
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
    ajax: "{{ route('admin.student-works.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'category', name: 'category' },
{ data: 'title', name: 'title' },
{ data: 'desc', name: 'desc' },
{ data: 'start_at', name: 'start_at' },
{ data: 'end_at', name: 'end_at' },
{ data: 'time_given_minute', name: 'time_given_minute' },
{ data: 'lesson_time_lesson_code', name: 'lesson_time.lesson_code' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-StudentWork').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection