@props(['id', 'label', 'required' => false, 'help', 'file' , 'type' => 'file', 'disable'=>false])
<div>
    <div class="form-group col-12">
        <label for="{{$id}}">{{$label}}</label>
        @if(!$disable)
            <div class="input-group">
                <input type="text" id="{{$id}}" {{$attributes}} {!! $attributes->merge(['class'=> 'form-control']) !!} name="image"
                       aria-label="Image" aria-describedby="button-image">
                <div class="input-group-append">
                    <button {{$disable ? 'disabled' : ''}} class="btn btn-outline-secondary" type="button" id="button-{{$id}}">انتخاب</button>
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

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.getElementById('button-{{$id}}').addEventListener('click', (event) => {
                event.preventDefault();

                window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
            });
        });

        // set file link
        function fmSetLink($url) {
        @this.set('{{$attributes->wire("model")->value}}', $url);
            document.getElementById('{{$id}}').value = $url;
        }
    </script>
@endpush

