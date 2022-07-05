@props(['data','article'])
<section class="breadcrumb-area pt-50px pb-50px bg-white pattern-bg">
    <div class="container">
        <div class="col-lg-8 mr-auto">
            <div class="breadcrumb-content">
                <div class="section-heading pb-3">
                    <h2 class="section__title">{{ $article->title }}</h2>
                </div>
                <ul class="generic-list-item generic-list-item-arrow d-flex flex-wrap align-items-center">
                    @foreach($data as $item)
                        <li><a  {{ !empty($item['link']) ? "href=".$item['link']." " : " " }} class="font-12 vazir">{{ $item['label'] }}</a></li>
                    @endforeach
                </ul>
                <ul class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center flex-wrap fs-14 pt-2">
                    <li class="d-flex align-items-center"> توسط <a >{{ $article->user->name }}</a></li>
                    <li class="d-flex align-items-center"> {{ $article->updated_date }}</li>
                    <li class="d-flex align-items-center"><a class="page-scroll">{{ $article->comments->count() }} نظر</a></li>
                </ul>
            </div>
            <!-- end breadcrumb-content -->
        </div>
        <!-- end col-lg-8 -->
    </div>
    <!-- end container -->
</section>
