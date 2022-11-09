<div>
    @section('title','نمونه سوال')
    <x-teacher.form-control :deleteAble="false"  mode="{{$mode}}" title="نمونه سوال"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-teacher.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-teacher.forms.input with="6" type="text" id="title" label="عنوان*" wire:model.defer="title"/>
                <x-teacher.forms.dropdown with="6" id="type" :data="$data['type']" label="نوع*" wire:model.defer="type"/>
                <x-teacher.forms.dropdown with="6" id="driver" :data="$data['storage']" label="فضای ذخیره سازی*" wire:model.defer="driver"/>
                <x-teacher.forms.lfm-standalone  id="file" label="فایل*" :file="$file"
                                               type="image" required="true" wire:model="file" />
                <x-teacher.forms.select2 id="course" :data="$data['course']" label=" دوره اموزشی"
                                       wire:model.defer="course" />
                <x-teacher.forms.full-text-editor id="description" label="توضیحات " wire:model.defer="description" />

            </div>
        </div>
    </div>
</div>
