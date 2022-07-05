@props(['id', 'label' ,'help' => false,'with' => 12])
<div class="form-group col-12 col-md-{{$with}}">
    <label for="{{$id}}">{{$label}}</label>
    <input id="{{$id}}" {{ $attributes }} {!! $attributes->merge(['class'=> 'form-control p-datepicker']) !!}
    x-data
           x-init="$('#{{$id}}').persianDatepicker({
           format: 'YYYY-MM-DD',
           onSelect: function () {
                    $dispatch('input', $('#{{$id}}').val())
                },

           });">
    @if($help)
        <small class="text-info">{{$help}}</small>
    @endif
    @error($id)
        <small class="text-danger d-block">{{ $message }}</small>
    @enderror
</div>
