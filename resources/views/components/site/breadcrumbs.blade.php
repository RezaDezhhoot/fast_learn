@props(['data','title' ,'pattern_bg' => false])
<section class="breadcrumb-area py-5 {{  $pattern_bg ? 'pattern-bg' : '' }}">
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-black">
                    {{ $title }}
                </h2>
            </div>
            <ul class="generic-list-item generic-list-item-black generic-list-item-arrow d-flex flex-wrap align-items-center">
                @foreach($data as $item)
                    <li><a  {{ !empty($item['link']) ? "href=".$item['link']." " : " " }} class="font-12 vazir">{{ $item['label'] }}</a></li>
                @endforeach
            </ul>
        </div>
        <!-- end breadcrumb-content -->
    </div>
    <!-- end container -->
</section>
