@props(['item'])
<a href="{{ route('courses',['organs'=>$item['id']]) }}" class="client-logo-item" {{ $attributes }}>
    <img src="{{ asset($item['logo']) }}" class="w-100" alt="تصویر نام تجاری">
</a>