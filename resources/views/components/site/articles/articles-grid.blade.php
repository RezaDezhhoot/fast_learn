@props(['data'])
<section class="get-started-area py-5 position-relative">
    <span class="ring-shape ring-shape-1"></span>
    <span class="ring-shape ring-shape-2"></span>
    <span class="ring-shape ring-shape-3"></span>
    <span class="ring-shape ring-shape-4"></span>
    <span class="ring-shape ring-shape-5"></span>
    <span class="ring-shape ring-shape-6"></span>
    <div class="container">
    <div class="section-heading text-right">
            <h5 class="ribbon ribbon-lg mb-2">فیدهای خبری</h5>
            <h2 class="section__title">{{$data['title']}}</h2>
            <span class="section-divider"></span>
            <div class="row">
                @foreach($data['content'] as $item)
                    <div class="col-lg-{{$data['widthCase']}} col-md-6 col-12">
                        <x-site.articles.article-box :item="$item"/>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
