<div>
    @section('title','فصل')
    <x-organ.form-control deleteAble="{{false}}"  mode="{{$mode}}" title="فصل" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-organ.forms.validation-errors />
        <div class="card-body">
            <div class="row">
                <x-organ.forms.input with="6" type="text" id="title" label="عنوان *" wire:model.defer="title" />
                <x-organ.forms.input with="6" type="number" id="view" label="نمایش *" wire:model.defer="view" />

                <x-organ.forms.select2  id="course" :data="$data['course']" label=" دوره اموزشی*"
                                          wire:model.defer="course" />
                <x-organ.forms.text-area label="توضیحات" wire:model.defer="description" id="description" />
            </div>
        </div>
    </div>
</div>
