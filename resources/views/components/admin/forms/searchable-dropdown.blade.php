@props(['id', 'label' , 'data' , 'required' => false , 'help' => false , 'value' => false,'with' => 12 ,'fn' => false , 'placeholder' => false ])
<div class="form-group col-md-{{$with}} col-12">
    <label for="{{$id}}"> {{$label}} </label>
    <input list="{{$id}}-list" id="{{$id}}" wire:input="{{$fn}}" placeholder="{{ $placeholder }}" {{ $attributes }} {!! $attributes->merge(['class'=> 'form-control']) !!} />
    <datalist id="{{$id}}-list">
        @foreach($data as $key => $item)
            <option value="{{ $value ? $item : $key }}">{{$item}}</option>
        @endforeach
    </datalist>
    @if($help)
        <small class="text-info">{{$help}}</small>
    @endif
    @error($id)
        <small class="text-danger d-block">{{ $message }}</small>
    @enderror
</div>
