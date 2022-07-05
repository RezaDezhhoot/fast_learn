<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold">پیام ها</h3>
        </div>
        <div class="dashboard-cards mb-5">
            @forelse($notifications as $item)
                <div class="border rounded p-2 my-3 custom-box-shadow" >
                    <small class="fs-11"> {{ $item->date }} </small>
                    <div class="py-3 fs-14">{!! $item->content  !!}</div>
                </div>
            @empty
                <p class="text-center alert alert-info">
                    شما هیچ گواهینامه ای ندارید.
                </p>
            @endforelse
        </div>
    </div>
</div>
