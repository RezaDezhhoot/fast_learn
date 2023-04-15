@props(['title' , 'key' ,'value' ,'icon','active' => false])
<li wire:click="$set('{{$key}}','{{$value}}')" class="nav-item mr-3 cursor-pointer">
    <a class="nav-link {{$active ? 'active' : ''}}" data-toggle="tab">
        <span class="nav-icon">
            <i class="{{$icon}}"></i>
        </span>
        <span  class="nav-text font-size-lg">{{$title}}</span>
    </a>
</li>
