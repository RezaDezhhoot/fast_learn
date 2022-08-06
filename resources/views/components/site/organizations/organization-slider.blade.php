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
            <h2 class="section__title theme-font-2 pb-4">{{ $data['title'] }}</h2>
        </div><!-- end section-heading -->
        <div class="client-logo-carousel pt-4">
            @foreach($data['content'] as $item)
                <x-site.organizations.organization-box :item="$item"/>
            @endforeach
        </div><!-- end client-logo-carousel -->
    </div><!-- end container -->
</section>