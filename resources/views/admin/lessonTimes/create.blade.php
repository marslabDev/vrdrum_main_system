@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.lessonTime.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lesson-times.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="date_from">{{ trans('cruds.lessonTime.fields.date_from') }}</label>
                <input class="form-control datetime {{ $errors->has('date_from') ? 'is-invalid' : '' }}" type="text" name="date_from" id="date_from" value="{{ old('date_from') }}" required>
                @if($errors->has('date_from'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_from') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTime.fields.date_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="class_room_id">{{ trans('cruds.lessonTime.fields.class_room') }}</label>
                <select class="form-control select2 {{ $errors->has('class_room') ? 'is-invalid' : '' }}" name="class_room_id" id="class_room_id" required>
                    @foreach($class_rooms as $id => $entry)
                        <option value="{{ $id }}" {{ old('class_room_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('class_room'))
                    <div class="invalid-feedback">
                        {{ $errors->first('class_room') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTime.fields.class_room_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lesson_id">{{ trans('cruds.lessonTime.fields.lesson') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson') ? 'is-invalid' : '' }}" name="lesson_id" id="lesson_id" required>
                    @foreach($lessons as $id => $entry)
                        <option value="{{ $id }}" {{ old('lesson_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTime.fields.lesson_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="coachs_efk[]">{{ trans('cruds.lessonTimeCoach.fields.coach_efk') }}</label>
                <select class="form-control select2 {{ $errors->has('coachs_efk[]') ? 'is-invalid' : '' }}" name="coachs_efk[]" id="coachs_efk" required>
                    @foreach($lesson_coachs as $lesson_id => $this_lesson_coachs)
                        @if($lesson_id == "")
                            <option value="{{ $this_lesson_coachs }}" parentLesson="" {{ old('coachs_efk[]') == $id ? 'selected' : '' }}>{{ $this_lesson_coachs }}</option>
                        @else
                            @foreach($this_lesson_coachs as $index => $value)
                                <option value="{{ $value->coach_efk }}" parentLesson="{{ $value->lesson_id }}" {{ old('coachs_efk[]') == $id ? 'selected' : '' }}>{{ $value->coach_efk }}</option>
                            @endforeach
                        @endif
                    @endforeach
                </select>
                @if($errors->has('coachs_efk[]'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coachs_efk[]') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonCoach.fields.coach_efk_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="student_efk">{{ trans('cruds.lessonTime.fields.student_efk') }}</label>
                <input class="form-control {{ $errors->has('student_efk') ? 'is-invalid' : '' }}" type="number" name="student_efk" id="student_efk" value="{{ old('student_efk', '') }}" step="1" required>
                @if($errors->has('student_efk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student_efk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTime.fields.student_efk_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
@section('scripts')
<script>
$(function () {
    var $date_select = $('#date_from')
    var $lesson_select = $('#lesson_id')
    var $coach_select = $('#coachs_efk')
    var $coach_options = $coach_select.find('option')
    

    $lesson_select.on('change', function(){
        coachOptionController()
    }).trigger('change');

    
    $date_select.on('dp.change', function(e){
        coachOptionController()
    }).trigger('change');


    function coachOptionController(){
        enableAllCoachOption()
        disableCoachOption()

        var $options = $coach_options.filter('[parentLesson="'+ $lesson_select.val() + '"]')

        if($options.length == 0){
            $coach_select.val("")
            $coach_select.html($coach_options.filter('[parentLesson=""]'))
        }else{
            $coach_select.val("")
            $coach_select.html($options)
        }
    }
    
    function disableCoachOption(){
        var $lesson_time_used = <?php echo $lesson_time_used ?>;

        var $time_used = $lesson_time_used.filter((e) => {
            return e['date_from'] <= $date_select.val() && $date_select.val() <= e['date_to']
        })

        $time_used.forEach(($value) => {
            if($value['coachs_efk'] != null){
                $value['coachs_efk'].forEach(($coach_id) => {
                    var $options = $coach_options.filter('[value="'+ $coach_id + '"]')

                    $options.each(($index, $option) => {
                        $option.disabled = true;
                    })
                })
            }
        })
    }

    function enableAllCoachOption(){
        var $options = $coach_options.filter('[disabled="disabled"]')

        $options.each(($index, $option) => {
            $option.disabled = false;
        })
    }
});
</script>
@endsection
