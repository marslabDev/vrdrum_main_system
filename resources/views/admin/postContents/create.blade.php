@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.postContent.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.post-contents.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.postContent.fields.resource_type') }}</label>
                <select class="form-control {{ $errors->has('resource_type') ? 'is-invalid' : '' }}" name="resource_type" id="resource_type" required>
                    <option value disabled {{ old('resource_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PostContent::RESOURCE_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('resource_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('resource_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('resource_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postContent.fields.resource_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.postContent.fields.submit_type') }}</label>
                <select class="form-control {{ $errors->has('submit_type') ? 'is-invalid' : '' }}" name="submit_type" id="submit_type">
                    <option value disabled {{ old('submit_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PostContent::SUBMIT_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('submit_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('submit_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('submit_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postContent.fields.submit_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.postContent.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postContent.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="desc">{{ trans('cruds.postContent.fields.desc') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('desc') ? 'is-invalid' : '' }}" name="desc" id="desc">{!! old('desc') !!}</textarea>
                @if($errors->has('desc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('desc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postContent.fields.desc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attachment">{{ trans('cruds.postContent.fields.attachment') }}</label>
                <div class="needsclick dropzone {{ $errors->has('attachment') ? 'is-invalid' : '' }}" id="attachment-dropzone">
                </div>
                @if($errors->has('attachment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attachment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postContent.fields.attachment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mark">{{ trans('cruds.postContent.fields.mark') }}</label>
                <input class="form-control {{ $errors->has('mark') ? 'is-invalid' : '' }}" type="number" name="mark" id="mark" value="{{ old('mark', '') }}" step="0.01">
                @if($errors->has('mark'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mark') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postContent.fields.mark_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('required_response') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="required_response" value="0">
                    <input class="form-check-input" type="checkbox" name="required_response" id="required_response" value="1" {{ old('required_response', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="required_response">{{ trans('cruds.postContent.fields.required_response') }}</label>
                </div>
                @if($errors->has('required_response'))
                    <div class="invalid-feedback">
                        {{ $errors->first('required_response') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postContent.fields.required_response_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="objective_selections">{{ trans('cruds.postContent.fields.objective_selections') }}</label>
                <input class="form-control {{ $errors->has('objective_selections') ? 'is-invalid' : '' }}" type="text" name="objective_selections" id="objective_selections" value="{{ old('objective_selections', '') }}">
                @if($errors->has('objective_selections'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objective_selections') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postContent.fields.objective_selections_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="objective_answers">{{ trans('cruds.postContent.fields.objective_answers') }}</label>
                <input class="form-control {{ $errors->has('objective_answers') ? 'is-invalid' : '' }}" type="text" name="objective_answers" id="objective_answers" value="{{ old('objective_answers', '') }}">
                @if($errors->has('objective_answers'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objective_answers') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postContent.fields.objective_answers_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lesson_time_post_id">{{ trans('cruds.postContent.fields.lesson_time_post') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson_time_post') ? 'is-invalid' : '' }}" name="lesson_time_post_id" id="lesson_time_post_id" required>
                    @foreach($lesson_time_posts as $id => $entry)
                        <option value="{{ $id }}" {{ old('lesson_time_post_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson_time_post'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson_time_post') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postContent.fields.lesson_time_post_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.post-contents.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $postContent->id ?? 0 }}');
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

<script>
    var uploadedAttachmentMap = {}
Dropzone.options.attachmentDropzone = {
    url: '{{ route('admin.post-contents.storeMedia') }}',
    maxFilesize: 1024, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1024
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="attachment[]" value="' + response.name + '">')
      uploadedAttachmentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAttachmentMap[file.name]
      }
      $('form').find('input[name="attachment[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($postContent) && $postContent->attachment)
          var files =
            {!! json_encode($postContent->attachment) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="attachment[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection