@props(['data'])
<section class="client-logo-area section-padding position-relative overflow-hidden text-center">
    <span class="stroke-shape stroke-shape-1"></span>
    <span class="stroke-shape stroke-shape-2"></span>
    <span class="stroke-shape stroke-shape-3"></span>
    <span class="stroke-shape stroke-shape-4"></span>
    <span class="stroke-shape stroke-shape-5"></span>
    <span class="stroke-shape stroke-shape-6"></span>
    <div class="container">
        <div class="section-heading">
            <h5 class="ribbon ribbon-lg mb-2">شرکای ما</h5>
            <h2 class="section__title">{{$data['title']}}</h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->
        <div class="client-logo-carousel pt-4">
            @foreach($data['content'] as $item)
                <x-site.organs.organ-box :item="$item"/>
            @endforeach
        </div><!-- end client-logo-carousel -->
    </div><!-- end container -->
</section><!-- end client-logo-area -->
