<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold">پرسش و پاسخ های من</h3>
        </div>
        <div class="dashboard-cards mb-5">
            @forelse($comments as $item)
                    <div class="shadow-sm">
                        <div class="media media-card   p-4 my-1 ">
                            <div class="media-img mr-4 rounded-full">
                                <img class="rounded-full lazy" src="{{ asset($item->user->image) }}" data-src="{{ asset($item->user->image) }}" alt="{{ $item->user->name }}" />
                            </div>
                            <div class="media-body">
                                <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                                    <h5>{{ $item->user->id == auth()->id() ? 'شما' : $item->user->name }}</h5>
                                    <small>
                                        <a>{{ $item->for_label.' '.($item->commentable_data['title'] ?? '') }}</a>
                                    </small>
                                </div>
                                <span class="d-block lh-18 pb-2">{{ $item->created_at->diffForHumans() }}</span>
                                <p class="pb-2">
                                    {!! $item->content !!}
                                </p>
                            </div>
                        </div>
                        @foreach($item->childrenRecursive as $value)
                            <div class="media media-card pb-2  p-4 my-1 review-reply">
                                <div class="media-img mr-4 rounded-full">
                                    <img class="rounded-full lazy" src="{{ asset($value->user->image) }}" data-src="{{ asset($value->user->image) }}" alt="{{ $value->user->name }}" />
                                </div>
                                <div class="media-body">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                                        <h5>{{ $value->user->id == auth()->id() ? 'شما' : $value->user->name }}</h5>
                                    </div>
                                    <span class="d-block lh-18 py-2">{{ $value->created_at->diffForHumans() }}</span>
                                    <p class="pb-2">
                                        {!! $value->content !!}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

            @empty
                <p class="alert alert-info text-center">
                    هیچ پرسش یا پاسخی وجود ندارد.
                </p>
            @endforelse
        </div>
    </div>
</div>
