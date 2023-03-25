@props(['data'])
<section class="get-started-area py-5 position-relative text-center">
    <span class="ring-shape ring-shape-1"></span>
    <span class="ring-shape ring-shape-2"></span>
    <span class="ring-shape ring-shape-3"></span>
    <span class="ring-shape ring-shape-4"></span>
    <span class="ring-shape ring-shape-5"></span>
    <span class="ring-shape ring-shape-6"></span>
    <div class="container">
        <div class="section-heading">
            <h5 class="ribbon ribbon-lg mb-2">شرکای ما</h5>
            <h2 class="section__title">{{$data['title']}}</h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->
        <div class="row">
            @foreach($data['content'] as $item)
                <div class="col-lg-{{$data['widthCase']}} col-md-6 col-12">
                    <x-site.organs.organ-box :item="$item"/>
                </div>
            @endforeach
        </div>
    </div>
</section>
