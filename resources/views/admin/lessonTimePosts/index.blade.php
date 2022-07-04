@extends('layouts.admin')
@section('content')
@can('lesson_time_post_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.lesson-time-posts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.lessonTimePost.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'LessonTimePost', 'route' => 'admin.lesson-time-posts.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.lessonTimePost.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-LessonTimePost">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.lessonTimePost.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.lessonTimePost.fields.group') }}
                    </th>
                    <th>
                        {{ trans('cruds.lessonTimePost.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.lessonTimePost.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.lessonTimePost.fields.publish_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.lessonTimePost.fields.terminate_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.lessonTimePost.fields.start_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.lessonTimePost.fields.end_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.lessonTimePost.fields.required_response') }}
                    </th>
                    <th>
                        {{ trans('cruds.lessonTimePost.fields.lesson_time') }}
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
@can('lesson_time_post_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.lesson-time-posts.massDestroy') }}",
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
    ajax: "{{ route('admin.lesson-time-posts.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'group', name: 'group' },
{ data: 'category', name: 'category' },
{ data: 'title', name: 'title' },
{ data: 'publish_at', name: 'publish_at' },
{ data: 'terminate_at', name: 'terminate_at' },
{ data: 'start_at', name: 'start_at' },
{ data: 'end_at', name: 'end_at' },
{ data: 'required_response', name: 'required_response' },
{ data: 'lesson_time_lesson_code', name: 'lesson_time.lesson_code' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-LessonTimePost').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection