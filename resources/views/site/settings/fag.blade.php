<div>
    <x-site.breadcrumbs :data="$page_address" title="سوالات متداول" />
    <section class="faq-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div id="accordion" class="generic-accordion generic-accordion-layout-2">
                        @foreach($fag as $key => $item)
                            <div class="card">
                                <div class="card-header" id="heading{{$key}}">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                                        <i class="la la-plus"></i>
                                        <i class="la la-minus"></i>
                                        {!! $item['question'] !!}
                                    </button>
                                </div><!-- end card-header -->
                                <div id="collapse{{$key}}" class="collapse {{ $key == 0 ? 'show' : ''  }}" aria-labelledby="heading{{$key}}" data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="card-text">
                                            {!! $item['answer'] !!}
                                        </p>
                                    </div><!-- end card-body -->
                                </div><!-- end collapse -->
                            </div><!-- end card -->
                        @endforeach
                    </div><!-- end generic-accordion -->
                </div><!-- end col-lg-7-->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
</div>
