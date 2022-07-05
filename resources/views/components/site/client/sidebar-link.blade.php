@props(['title','link','icon','active'])
<li class="{{ $active ? 'page-active' : '' }} ">
    <a href="{{ $link }}"> <i class="{{ $icon }} la-2x" ></i>{{ $title }} </a>
</li>
