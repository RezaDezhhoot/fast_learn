@props(['label'])
<div class="form-group" {{$attributes}}>
    <p>
        {!! $label !!}
    </p>
    <div>
        {{ $slot }}
    </div>
</div>
