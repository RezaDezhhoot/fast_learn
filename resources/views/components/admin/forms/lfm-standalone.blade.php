@props(['id', 'label', 'required' => false, 'help', 'file' , 'type' => 'file', 'disable'=>false])
<div>
    <div class="form-group col-12">
        <label for="{{$id}}">{{$label}}</label>
        @if(!$disable)
            <div class="input-group">
                <input  id="{{$id}}" {!! $attributes->merge(['class'=> 'form-control']) !!}
                x-data
                       x-init="$('#lfm-{{$id}}').filemanager('file'); $('#{{$id}}').on('change', function () { $dispatch('input', $(this).val()) })">
                <div class="input-group-append">
                    <button id="lfm-{{$id}}" type="button"  {{$disable ? 'disabled' : ''}} class="btn btn-outline-secondary"
                            data-input="{{$id}}" data-preview="holder">انتخاب
                    </button>
                </div>
            </div>
        @endif
    </div>
    @if(gettype($file) == 'string')
            <div class="form-group col-12">
                @foreach(explode(',', $file) as $key => $item)
                    <img src="{{asset($item)}}" alt="{{$id}}" width="120px" height="100px" class="mr-1 mb-1 imglist" style="border-radius: 5px"/>
                @endforeach
            </div>
    @endif
</div>
