@props(['id', 'label'])
<div class="form-group col-12">
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <div style="padding: 5px">
        <div wire:ignore>
            <label for="{{$id}}">{{$label}} </label>
            <textarea {{ $attributes->wire('model') }} id="{{$id}}" class="resizable_textarea form-control"
                      x-data="{text: @entangle($attributes->wire('model')) }"
                      x-init="CKEDITOR.replace('{{$id}}', {
                            language: 'fa',
                            filebrowserImageBrowseUrl: '/file-manager/ckeditor'
                        });
                        CKEDITOR.instances.{{$id}}.on('change', function () {
                            $dispatch('input', CKEDITOR.instances.{{$id}}.getData())
                        });"
                      x-text="CKEDITOR.instances.{{$id}}.setData(this.text); return this.text">
            </textarea>
        </div>
    </div>

</div>

