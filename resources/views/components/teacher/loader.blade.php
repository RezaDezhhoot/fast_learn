@props(['text'=>'در حال پردازش'])
<div class="form-group col-12">
    <div class="middle" wire:loading {{ $attributes }} >
        <small class="text-gray"> {{$text}} </small>
        <div class="bar bar1"></div>
        <div class="bar bar2"></div>
        <div class="bar bar3"></div>
        <div class="bar bar4"></div>
        <div class="bar bar5"></div>
        <div class="bar bar6"></div>
        <div class="bar bar7"></div>
        <div class="bar bar8"></div>
    </div>
</div>
