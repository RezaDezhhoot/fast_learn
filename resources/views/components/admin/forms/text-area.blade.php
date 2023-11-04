@props(['id', 'label' , 'disabled' => false ,'dir' => 'rtl' , 'help' => false])
<div class="form-group col-12">
    <div style="padding: 5px">
        <label for="{{$id}}">{{$label}} </label>
        <textarea {{ $attributes->wire('model') }} dir="{{$dir}}" {{ $disabled ? 'disabled' : '' }} id="{{$id}}" class="resizable_textarea form-control"></textarea>
        @error($id)
        <small class="text-danger d-block">{{ $message }}</small>
        @enderror
        @if($help)
            <small class="text-info">{{$help}}</small>
        @endif
    </div>
</div>
