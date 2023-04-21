<div>
    @section('title','فصل')
    <x-teacher.form-control deleteAble="{{false}}"  mode="{{$mode}}" title="فصل" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-teacher.forms.validation-errors />
        <div class="card-body">
            <div class="row">
                <x-teacher.forms.input with="6" type="text" id="title" label="عنوان *" wire:model.defer="title" />
                <x-teacher.forms.input with="6" type="number" id="view" label="نمایش *" wire:model.defer="view" />

                <x-teacher.forms.select2  id="course" :data="$data['course']" label=" دوره آموزشی*"
                                       wire:model.defer="course" />
                <x-teacher.forms.text-area label="توضیحات" wire:model.defer="description" id="description" />
            </div>
        </div>
    </div>
</div>
