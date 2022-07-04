@extends('layouts.admin')
@section('content')
@can('post_content_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.post-contents.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.postContent.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'PostContent', 'route' => 'admin.post-contents.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.postContent.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PostContent">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.postContent.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.postContent.fields.resource_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.postContent.fields.submit_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.postContent.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.postContent.fields.attachment') }}
                    </th>
                    <th>
                        {{ trans('cruds.postContent.fields.mark') }}
                    </th>
                    <th>
                        {{ trans('cruds.postContent.fields.required_response') }}
                    </th>
                    <th>
                        {{ trans('cruds.postContent.fields.objective_selections') }}
                    </th>
                    <th>
                        {{ trans('cruds.postContent.fields.objective_answers') }}
                    </th>
                    <th>
                        {{ trans('cruds.postContent.fields.lesson_time_post') }}
                    </th>
                    <th>
                        {{ trans('cruds.lessonTimePost.fields.title') }}
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
@can('post_content_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.post-contents.massDestroy') }}",
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
    ajax: "{{ route('admin.post-contents.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'resource_type', name: 'resource_type' },
{ data: 'submit_type', name: 'submit_type' },
{ data: 'title', name: 'title' },
{ data: 'attachment', name: 'attachment', sortable: false, searchable: false },
{ data: 'mark', name: 'mark' },
{ data: 'required_response', name: 'required_response' },
{ data: 'objective_selections', name: 'objective_selections' },
{ data: 'objective_answers', name: 'objective_answers' },
{ data: 'lesson_time_post_title', name: 'lesson_time_post.title' },
{ data: 'lesson_time_post.title', name: 'lesson_time_post.title' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-PostContent').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection