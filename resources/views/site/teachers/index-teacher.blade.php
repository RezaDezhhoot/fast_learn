<div>
    <x-site.breadcrumbs :data="$page_address" title="مدرسین" />
    <section class="team-member-area">
        <div class="container">
            <div class="row">
                @forelse($teachers as $item)
                    <div class="col-lg-3 responsive-column-half">
                        <div class="card card-item member-card text-center">
                            <div class="w-100 text-center">
                                <img class=" teacher-image" src="{{ asset($item->user->image) }}" alt="{{ $item->user->name }}" />
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('teacher',$item->id) }}">{{ $item->user->name }}</a></h5>
                                <p class="card-text">معلم</p>
                                <a href="{{ route('teacher',$item->id) }}" class="btn theme-btn theme-btn-sm theme-btn-transparent mt-3">مشاهده نمایه <i class="la la-arrow-left icon ml-1"></i></a>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                @empty
                    <div class="text-center mx-auto mb-3">
                        <img class="mx-auto d-block mt-5" src="{{ asset('site/svg/No-data-cuate.svg') }}"
                             alt="">
                        <h5 class="mt-3">ما هیچ  مدرسی پیدا نکردیم!</h5>
                    </div>
                @endforelse
            </div>
            <!-- end row -->
            <div class="load-more-btn-box pt-3 text-center">
                {{$teachers->links('site.includes.paginate')}}
            </div>
        </div>
        <!-- end container -->
    </section>
</div>
