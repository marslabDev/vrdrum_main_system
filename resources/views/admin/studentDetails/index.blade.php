@extends('layouts.admin')
@section('content')
@can('student_detail_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.student-details.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.studentDetail.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'StudentDetail', 'route' => 'admin.student-details.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.studentDetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-StudentDetail">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.studentDetail.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.studentDetail.fields.full_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.studentDetail.fields.parent_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.studentDetail.fields.parent_phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.studentDetail.fields.lesson_categories') }}
                    </th>
                    <th>
                        {{ trans('cruds.studentDetail.fields.lesson_group') }}
                    </th>
                    <th>
                        {{ trans('cruds.studentDetail.fields.is_disabled') }}
                    </th>
                    <th>
                        {{ trans('cruds.studentDetail.fields.student_efk') }}
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
@can('student_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.student-details.massDestroy') }}",
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
    ajax: "{{ route('admin.student-details.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'full_name', name: 'full_name' },
{ data: 'parent_name', name: 'parent_name' },
{ data: 'parent_phone', name: 'parent_phone' },
{ data: 'lesson_categories', name: 'lesson_categories' },
{ data: 'lesson_group', name: 'lesson_group' },
{ data: 'is_disabled', name: 'is_disabled' },
{ data: 'student_efk', name: 'student_efk' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-StudentDetail').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection