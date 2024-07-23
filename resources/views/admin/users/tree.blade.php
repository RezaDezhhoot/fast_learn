<ul>
    <li>
        <details>
            <summary><a target="_blank" href="{{ route('admin.store.user',['edit',$identification->id]) }}">{{ $identification->name }}</a></summary>
            @if($identification->identification)
                <hr>
                @include('admin.users.tree' , ['identification' => $identification->identification])
            @endif
        </details>
    </li>
</ul>
