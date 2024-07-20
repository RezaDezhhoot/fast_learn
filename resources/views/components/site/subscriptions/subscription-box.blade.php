@props(['item'])
<div class="card card-item " {{ $attributes }}>
    <div class="card-image">
        <a  class="d-block">
            <img class="card-img-top" src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}">
        </a>

    </div><!-- end card-image -->
    <div class="card-body">
        <h5 class="card-title"><a >{{ $item['title'] }}</a></h5>
        <div class="d-flex justify-content-between align-items-center">
            <p class="card-price text-black font-weight-bold">
                {{ number_format($item['amount']) }} تومان
            </p>
        </div>
        <hr>
        <div class="w-100">
            <button wire:loading.attr="disabled" wire:click="buySub('{{ $item['id'] }}')" class="btn w-100 btn-danger">حرید</button>
        </div>
    </div><!-- end card-body -->
</div>
