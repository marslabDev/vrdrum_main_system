@extends('layouts.admin')
@section('content')
@can('submission_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.submissions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.submission.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Submission', 'route' => 'admin.submissions.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.submission.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Submission">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.submission.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.submission.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.submission.fields.submit_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.submission.fields.mark') }}
                    </th>
                    <th>
                        {{ trans('cruds.submission.fields.mark_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.submission.fields.student_work') }}
                    </th>
                    <th>
                        {{ trans('cruds.studentWork.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.submission.fields.student_efk') }}
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
@can('submission_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.submissions.massDestroy') }}",
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
    ajax: "{{ route('admin.submissions.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'status', name: 'status' },
{ data: 'submit_at', name: 'submit_at' },
{ data: 'mark', name: 'mark' },
{ data: 'mark_at', name: 'mark_at' },
{ data: 'student_work_title', name: 'student_work.title' },
{ data: 'student_work.title', name: 'student_work.title' },
{ data: 'student_efk', name: 'student_efk' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Submission').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection