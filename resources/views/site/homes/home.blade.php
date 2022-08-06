<div>
    <livewire:site.includes.site.slider />

    @if (sizeof($box) > 0)
    <div class="container">
        <div class="row mt-50px">
            @foreach($box as $item)
                <x-site.shape-box :item="$item" />
            @endforeach
        </div>
    </div>
    @endif
    
    <div class="row">
        @foreach($content as $item)
        <div class="col-lg-{{$item['width']}} col-12 px-4">
            @switch($item['category'])
            @case('categories')
            @if($item['type'] == 'slider')
            <x-site.categories.category-slider :data="$item" />
            @else
            <x-site.categories.category-grid :data="$item" />
            @endif
            @break
            @case('organizations')
            @if($item['type'] == 'slider')
            <x-site.organizations.organization-slider :data="$item" />
            @else
            <x-site.organizations.organization-grid :data="$item" />
            @endif
            @break
            @case('courses')
            @if($item['type'] == 'slider')
            <x-site.courses.course-slider :data="$item" />
            @else
            <x-site.courses.course-grid :data="$item" />
            @endif
            @break
            @case('articles')
            @if($item['type'] == 'slider')
            <x-site.articles.articles-slider :data="$item" />
            @else
            <x-site.articles.articles-grid :data="$item" />
            @endif
            @break
            @case('banners')
            <x-site.banners.banner :data="$item" />
            @break
            @endswitch
        </div>
        @endforeach
        <div class="col-12">
            <x-site.counter :data="$starter" />
        </div>
    </div>
</div>