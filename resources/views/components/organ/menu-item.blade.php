@props(['icon','label','active','new'=>0])
<li class="menu-item {{$active  ? 'menu-item-active' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
    <a {!! $attributes !!} class="menu-link">
        <i class="menu-icon {{$icon}}">
            <span></span>
        </i>
        <span class="menu-text">{{ $label }}</span>
        @if($new > 0)
            <span class="menu-label">
                <span class="label label-danger label-inline">{{$new}} جدید   </span>
            </span>
        @endif
    </a>
</li>
