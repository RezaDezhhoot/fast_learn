@props(['item'])
<a href="{{route('organ',$item['slug'])}}" class="client-logo-item p-1"><img src="{{asset( $item['info']['logo'] ?? '')}}" alt="{{$item['title']}}"></a>
