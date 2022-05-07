@extends('layouts.admin')
@section('content')
@can('student_work_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.student-works.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.studentWork.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.studentWork.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-StudentWork">
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
                <tbody>
                    @foreach($studentWorks as $key => $studentWork)
                        <tr data-entry-id="{{ $studentWork->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $studentWork->id ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\StudentWork::CATEGORY_SELECT[$studentWork->category] ?? '' }}
                            </td>
                            <td>
                                {{ $studentWork->title ?? '' }}
                            </td>
                            <td>
                                {{ $studentWork->desc ?? '' }}
                            </td>
                            <td>
                                {{ $studentWork->start_at ?? '' }}
                            </td>
                            <td>
                                {{ $studentWork->end_at ?? '' }}
                            </td>
                            <td>
                                {{ $studentWork->time_given_minute ?? '' }}
                            </td>
                            <td>
                                {{ $studentWork->lesson_time->lesson_code ?? '' }}
                            </td>
                            <td>
                                @can('student_work_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.student-works.show', $studentWork->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('student_work_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.student-works.edit', $studentWork->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('student_work_delete')
                                    <form action="{{ route('admin.student-works.destroy', $studentWork->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('student_work_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.student-works.massDestroy') }}",
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
  let table = $('.datatable-StudentWork:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection