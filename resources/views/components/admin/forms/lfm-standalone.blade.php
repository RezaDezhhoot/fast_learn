@props(['id', 'label', 'required' => false, 'help', 'file' , 'type' => 'file', 'disable'=>false,'with' => 12, 'hidden' => false])
<div class="col-{{$with}} "
    {{ $hidden ? 'hidden' : '' }}
>
    <div class="form-group w-100">
        <label for="{{$id}}">{{$label}}</label>
        @if(!$disable)
            <div class="input-group d-flex align-items-center justify-content-center">
                @if($file && gettype($file) == 'string')
                    @foreach(explode(',', $file) as $key => $item)
                        <img src="{{asset($item)}}"  width="40px" height="40px" class="mr-1 mb-1 imglist"
                             style="border-radius: 5px" />
                    @endforeach
                @endif
                <input type="text" {{ $attributes->wire('model') }} id="{{$id}}" {!! $attributes->merge(['class'=>
            'form-control']) !!} name="image"
                       aria-label="Image" aria-describedby="button-image"
                       x-data
                       x-init="$('#{{$id}}').on('change', function () {alert(2); $dispatch('input', $(this).val()) })"
                >
                <div class="input-group-append">
                    <button onclick="openWindow('{{$id}}')" {{$disable ? 'disabled' : '' }} class="btn btn-outline-secondary" type="button"
                            id="button-{{$id}}">انتخاب</button>
                </div>
            </div>
        @endif
    </div>

</div>
@push('scripts')
<script>
    var id , input , input_id;
    function openWindow(id) {
        input_id = id.replace("button-", '');
        input = document.getElementById(input_id);
        window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
    }
        // set file link

        function fmSetLink($url) {
            input.value = $url;
            @this.set(input_id, $url);
        }
</script>
@endpush
