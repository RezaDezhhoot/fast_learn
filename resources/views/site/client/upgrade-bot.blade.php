<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold"> آپگرید ربات </h3>
        </div>
        <div class="dashboard-cards mb-5">

            @forelse($items as $item)
                <div class="col-6 col-md-3">
                    <div class="card card-item card-preview">
                        <div class="card-image">
                            <a class="d-block">
                                <img class="card-img-top" src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" />
                            </a>

                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><a >{{ $item['title'] }}</a></h5>

                            <!-- end rating-wrap -->
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-price text-black font-weight-bold">
                                    {{ number_format($item['amount']) }} <i class="la  la-coins" style="color: gold"></i>
                                </p>
                                <p class="card-price text-black font-weight-bold">
                                    درامد ربات:
                                     {{ number_format($item['profit']) }}+ <i class="la  la-coins" style="color: gold"></i>
                                </p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button {{ (auth()->user()->balance < $item->amount || auth()->user()->botPlans()->where('bot_plan_id' , $item->id)->exists()) ? 'disabled' : '' }} wire:click="start('{{ $item->id }}')" class="btn w-100 btn-danger">
                                فعال کردن
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="custom-box-shadow d-flex align-items-center justify-content-center alert alert-info">
                    <p>
                         هنوز هیج پلنی وجود ندارد.
                    </p>
                </div>
            @endforelse

        </div>
    </div>
</div>
