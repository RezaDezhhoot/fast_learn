<div>
    @section('title','رویداد جدید')
    <x-admin.form-control  mode="{{$mode}}" title="رویداد" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" type="text" id="title" label="عنوان*" wire:model.defer="title"/>
                <x-admin.forms.dropdown with="6" id="event" :data="$data['event']" label="عملیات رویداد*" wire:model.defer="event"/>
{{--                <x-admin.forms.dropdown with="6" id="count" :data="$data['count']" label="تعداد *" wire:model.defer="count"/>--}}
                <x-admin.forms.dropdown with="6" id="orderBy" :data="$data['orderBy']" label="مرتب سازی کاربران بر اساس*" wire:model.defer="orderBy"/>
                <x-admin.forms.dropdown with="6" id="category" :data="$data['category']" label="کاربران هدف" wire:model="category"/>
                <div class="col-12 {{ $category == \App\Enums\EventEnum::TARGET_COURSES ? 'd-block' : 'd-none' }}">
                    <x-admin.forms.select2 id="course" :data="$data['course']" label="فیلتر بر حسب دوره اموزشی" wire:model.defer="course"/>
                </div>
            </div>
            <hr>
            <x-admin.forms.text-area label="متن اصلی*" wire:model.defer="body" id="body" />
            <x-admin.form-section label="پارامتر ها">
                <div class="row mx-2 py-2">
                    @foreach($vars as $key => $value)
                        <div class="col-2">
                            <p class="text-base m-0"> {{ $key }} </p>
                            <small class="text-info">{{$value}}</small>
                        </div>
                    @endforeach
                </div>
            </x-admin.form-section>
        </div>
    </div>
</div>
