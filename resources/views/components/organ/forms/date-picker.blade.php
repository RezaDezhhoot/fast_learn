@props(['id', 'label', 'help', 'required' => false ,'with' => 12])
<div class="form-group col-12 col-md-{{$with}}">
    <label for="{{$id}}"> {{$label}}{{$required ? '*' : ''}}</label>
     <input id="{{$id}}" {!! $attributes->merge(['class'=> 'form-control p-datepicker']) !!}
    x-data
           x-init="$('#{{$id}}').pDatepicker({
                initialValue: false,
                autoClose: true,
                calendarType: 'gregorian',
                calendar: {
                    'persian': {
                    'locale': 'en',
                    'showHint': true,
                    'leapYearMode': 'algorithmic'
                    },
                    'gregorian': {
                        'locale': 'en',
                        'showHint': true
                    },
                },
                toolbox: {
                    'enabled': true,
                    'calendarSwitch': {
                    'enabled': false,
                    },
                },
                format: 'YYYY-MM-DD',
                onSelect: function () {
                    $dispatch('input', $('#{{$id}}').val())
                }
                });">
    @isset($help)
        <small class="text-muted">{{$help}}</small>
    @endisset
</div>
