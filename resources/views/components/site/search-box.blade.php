@props(['class' => 'flex-grow-1 mr-3'])
<form method="get" wire:submit.prevent="search" class="{{ $class }}">
    <div class="form-group mb-0">
        <input class="form-control form--control pl-3" wire:model.defer="q" type="text" name="search" placeholder="هر چیزی را جستجو کنید" />
        <span wire:click="search" class="la la-search search-icon"></span>
    </div>
</form>
