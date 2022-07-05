@props(['data','teacher'])
<section class="breadcrumb-area py-5 bg-white pattern-bg">
    <div class="container">
        <div class="breadcrumb-content">
            <div class="media media-card align-items-center pb-4">
                <div class="media-img media--img media-img-md rounded-full">
                    <img class="rounded-full" src="{{ asset($teacher->user->image) }}" alt="{{ $teacher->user->name }}" />
                </div>
                <div class="media-body">
                    <h2 class="section__title fs-30">{{ $teacher->user->name }}</h2>
                    <span class="d-block lh-18 pt-1 pb-2">{{ $teacher->created_at->diffForHumans() }}</span>
                    <p class="lh-18">{{ $teacher->sub_title }}</p>
                </div>
            </div>
            <!-- end media -->
        </div>
        <!-- end breadcrumb-content -->
    </div>
    <!-- end container -->
</section>
