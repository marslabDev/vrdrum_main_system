@extends('layouts.admin')
@section('content')
@can('lesson_time_coach_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.lesson-time-coaches.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.lessonTimeCoach.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.lessonTimeCoach.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-LessonTimeCoach">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.lessonTimeCoach.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTimeCoach.fields.lesson_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTimeCoach.fields.coach') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lessonTimeCoaches as $key => $lessonTimeCoach)
                        <tr data-entry-id="{{ $lessonTimeCoach->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $lessonTimeCoach->id ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTimeCoach->lesson_time->lesson_code ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTimeCoach->coach->name ?? '' }}
                            </td>
                            <td>
                                @can('lesson_time_coach_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.lesson-time-coaches.show', $lessonTimeCoach->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('lesson_time_coach_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.lesson-time-coaches.edit', $lessonTimeCoach->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('lesson_time_coach_delete')
                                    <form action="{{ route('admin.lesson-time-coaches.destroy', $lessonTimeCoach->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('lesson_time_coach_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.lesson-time-coaches.massDestroy') }}",
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
  let table = $('.datatable-LessonTimeCoach:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection