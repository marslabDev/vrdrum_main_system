@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.lessonTimePost.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lesson-time-posts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="group">{{ trans('cruds.lessonTimePost.fields.group') }}</label>
                <input class="form-control {{ $errors->has('group') ? 'is-invalid' : '' }}" type="text" name="group" id="group" value="{{ old('group', '') }}" required>
                @if($errors->has('group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimePost.fields.group_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.lessonTimePost.fields.category') }}</label>
                <select class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category" id="category" required>
                    <option value disabled {{ old('category', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\LessonTimePost::CATEGORY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('category', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimePost.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.lessonTimePost.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimePost.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="desc">{{ trans('cruds.lessonTimePost.fields.desc') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('desc') ? 'is-invalid' : '' }}" name="desc" id="desc">{!! old('desc') !!}</textarea>
                @if($errors->has('desc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('desc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimePost.fields.desc_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="publish_at">{{ trans('cruds.lessonTimePost.fields.publish_at') }}</label>
                <input class="form-control datetime {{ $errors->has('publish_at') ? 'is-invalid' : '' }}" type="text" name="publish_at" id="publish_at" value="{{ old('publish_at') }}" required>
                @if($errors->has('publish_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('publish_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimePost.fields.publish_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="terminate_at">{{ trans('cruds.lessonTimePost.fields.terminate_at') }}</label>
                <input class="form-control datetime {{ $errors->has('terminate_at') ? 'is-invalid' : '' }}" type="text" name="terminate_at" id="terminate_at" value="{{ old('terminate_at') }}">
                @if($errors->has('terminate_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('terminate_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimePost.fields.terminate_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_at">{{ trans('cruds.lessonTimePost.fields.start_at') }}</label>
                <input class="form-control datetime {{ $errors->has('start_at') ? 'is-invalid' : '' }}" type="text" name="start_at" id="start_at" value="{{ old('start_at') }}">
                @if($errors->has('start_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimePost.fields.start_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_at">{{ trans('cruds.lessonTimePost.fields.end_at') }}</label>
                <input class="form-control datetime {{ $errors->has('end_at') ? 'is-invalid' : '' }}" type="text" name="end_at" id="end_at" value="{{ old('end_at') }}">
                @if($errors->has('end_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimePost.fields.end_at_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('required_response') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="required_response" value="0">
                    <input class="form-check-input" type="checkbox" name="required_response" id="required_response" value="1" {{ old('required_response', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="required_response">{{ trans('cruds.lessonTimePost.fields.required_response') }}</label>
                </div>
                @if($errors->has('required_response'))
                    <div class="invalid-feedback">
                        {{ $errors->first('required_response') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimePost.fields.required_response_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lesson_time_id">{{ trans('cruds.lessonTimePost.fields.lesson_time') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson_time') ? 'is-invalid' : '' }}" name="lesson_time_id" id="lesson_time_id" required>
                    @foreach($lesson_times as $id => $entry)
                        <option value="{{ $id }}" {{ old('lesson_time_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lessonTimePost.fields.lesson_time_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.lesson-time-posts.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $lessonTimePost->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection