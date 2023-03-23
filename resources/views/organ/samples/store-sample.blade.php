<div>
    @section('title','نمونه سوال')
    <x-organ.form-control :deleteAble="false"  mode="{{$mode}}" title="نمونه سوال"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-organ.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-organ.forms.input with="6" type="text" id="title" label="عنوان*" wire:model.defer="title"/>
                <x-organ.forms.dropdown with="6" id="type" :data="$data['type']" label="نوع*" wire:model.defer="type"/>
                <x-organ.forms.dropdown with="6" id="driver" :data="$data['storage']" label="فضای ذخیره سازی*" wire:model.defer="driver"/>
                <x-organ.forms.lfm-standalone  id="file" label="فایل*" :file="$file"
                                                 type="image" required="true" wire:model="file" />
                <x-organ.forms.select2 id="course" :data="$data['course']" label=" دوره اموزشی"
                                         wire:model.defer="course" />
                <x-organ.forms.full-text-editor id="description" label="توضیحات " wire:model.defer="description" />

            </div>
        </div>
    </div>
</div>
