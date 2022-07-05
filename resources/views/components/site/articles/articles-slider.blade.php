@props(['data'])
<section class="blog-area py-5 bg-gray overflow-hidden">
    <div class="container">
        <div class="section-heading text-right">
            <h5 class="ribbon ribbon-lg mb-2">فیدهای خبری</h5>
            <h2 class="section__title">{{$data['title']}}</h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->
        <div class="blog-post-carousel owl-action-styled half-shape mt-30px">
            @foreach($data['content'] as $item)
                <x-site.articles.article-box :item="$item"/>
            @endforeach
        </div>
    </div>
</section>
