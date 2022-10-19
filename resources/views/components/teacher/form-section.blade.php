@props(['label' ,'class'=>'form-group'])
<div class="{{$class}}" {{$attributes}}>
    <p>
        {!! $label !!}
    </p>
    <div>
        {{ $slot }}
    </div>
</div>
