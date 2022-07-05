@props(['id', 'label'])
<div>
    <div class="form-group">
        <div wire:ignore>
            @if(!empty($label))
                <label for="{{$id}}">{{$label}} </label>
            @endif
            <textarea {{ $attributes }} id="{{$id}}" x-data="{text: @entangle($attributes->wire('model')) }"
                      x-init="CKEDITOR.replace('{{$id}}', {
                            language: 'fa',
                        });
                        CKEDITOR.instances.{{$id}}.on('change', function () {
                            $dispatch('input', CKEDITOR.instances.{{$id}}.getData())
                        });"
                      x-text="CKEDITOR.instances.{{$id}}.setData(this.text); return this.text"></textarea>
        </div>
        @error($id)
        <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    <script src="https://cdn.ckeditor.com/4.13.0/basic/ckeditor.js"></script>
</div>
