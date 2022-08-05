@props(['id', 'label' , 'data' , 'help' => false ,'child','parent_key' ,'parent_value' , 'child_key' ,'child_value' ])
<div class="form-group col-12">
    <label for="{{$id}}"> {{$label}} </label>
    <select {{ $attributes }}  id="{{$id}}"  {!! $attributes->merge(['class'=> 'form-control']) !!}>
        <option value="">انتخاب</option>
        @foreach($data as $key => $item)
        <optgroup label="{{ $item[$parent_value] }}">
            
            <option value="{{ $item[$parent_key] }}">{{ $item[$parent_value] }}</option>
            @foreach ($item[$child] as $child)
                <option value="{{ $child[$child_key] }}">{{ $child[$child_value] }}</option>
            @endforeach
        </optgroup>
           
            
        @endforeach
    </select>
    @if($help)
        <small class="text-info">{{$help}}</small>
    @endif
    @error($id)
        <small class="text-danger d-block">{{ $message }}</small>
    @enderror
</div>
