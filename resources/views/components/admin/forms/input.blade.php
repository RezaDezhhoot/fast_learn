@props(['id', 'label', 'type' , 'required' => false ,'disabled' => false ,'help' => false,'with' => 12 , 'hidden' => false ])
<div class="form-group col-12 col-md-{{$with}}"  {{ $hidden ? 'hidden' : '' }}>
    <label for="{{$id}}">{{$label}}</label>
    <input  {!! $attributes->merge(['class'=> 'form-control']) !!} {{ $disabled ? 'disabled' : '' }} type="{{$type}}" id="{{$id}}" {{ $attributes }}>
    @if($help)
        <small class="text-info">{{$help}}</small>
    @endif
    @error($id)
        <small class="text-danger d-block">{{ $message }}</small>
    @enderror
</div>
