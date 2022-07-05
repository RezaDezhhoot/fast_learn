<div>
    @section('title','تنظیمات ضفحه اصلی')
    <x-admin.form-control  title="تنظیمات "/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <x-admin.form-section label="اسلایدر ابتدا">
                <x-admin.forms.full-text-editor id="content" label="متن*" wire:model.defer="slider"/>
                <x-admin.forms.lfm-standalone id="sliderImage" label="تصویر پس زمینه*" :file="$sliderImage" type="image" required="true" wire:model="sliderImage"/>
                <x-admin.forms.input type="url" id="sliderLink" label="لینک مورد نظر" wire:model.defer.defer="sliderLink"/>
            </x-admin.form-section>
            <x-admin.form-section label="محتوا">
                <x-admin.button class="btn btn-light-primary font-weight-bolder btn-sm" content="افزودن " wire:click="addContent('new')" />
                <table class="table table-striped table-bordered dt-responsive">
                    <thead>
                    <tr>
                        <td>عنوان</td>
                        <td>نوع محتوا</td>
                        <td>نوع نمایش</td>
                        <td>شماره نمایش</td>
                        <th>عرض محتوا</th>
                        <td>عملیات</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($content->sortBy('view') as $key => $value)
                        <tr>
                            <td>{{ $value['title'] ?? '' }}</td>
                            <td>{{ $data['category'][$value['category']] ?? '' }}</td>
                            <td>{{ $data['type'][$value['type']] ?? '' }}</td>
                            <td>{{ $value['view'] }}</td>
                            <td>{{ $data['width'][$value['width']] ?? '' }}</td>
                            <td>
                                <button type="button"  wire:click="addContent('{{$key}}')" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2">
                                    <span class="svg-icon svg-icon-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>
                                                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </button>
                                <x-admin.delete-btn wire:click="unSetContent({{$key}})" />
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </x-admin.form-section>
            <x-admin.modal-page id="content" title="{{ $titleContent }}" wire:click="storeContent">
                <x-admin.forms.validation-errors/>
                <x-admin.forms.input type="text" id="title" label="عنوان*" wire:model.defer="title"/>
                <x-admin.forms.input type="number" id="view" label="شماره نمایش*" wire:model.defer="view"/>
                <x-admin.forms.dropdown id="category" :data="$data['category']" label="نوع محتوا*" wire:model="category"/>
                <x-admin.forms.dropdown id="width" :data="$data['width']" label="عرض محتوا*" wire:model="width"/>
                @if($category <> 'banners')
                    <x-admin.forms.dropdown id="type" :data="$data['type']" label="نوع نمایش*" wire:model="type"/>
                    @if($type <> 'slider')
                        <x-admin.forms.dropdown id="widthCase" :data="$data['width']" label="عرض هر باکس*" wire:model.defer="widthCase"/>
                    @endif
                    <x-admin.forms.input type="url" id="moreLink" label="لینک صفحه نمایش همه" wire:model.defer.defer="moreLink"/>
                    <x-admin.button class="btn btn-light-primary font-weight-bolder btn-sm" content="افزودن مورد" wire:click="addContentCase('new')" />
                    @foreach($contentCase as $key => $value)
                        <div style="display: flex;align-items: center">
                            <x-admin.forms.input with="11" type="text" id="contentCase{{$key}}" label="شماره شناسه*" wire:model.defer="contentCase.{{$key}}"/>
                            <x-admin.button class="danger" style="margin-top: 28px;" content="حذف " wire:click="unSetCase({{ $key }})" />
                        </div>
                    @endforeach
                @elseif($category == 'banners')
                    <x-admin.forms.full-text-editor id="bannerContent" label="متن*" wire:model.defer="bannerContent"/>
                    <x-admin.forms.lfm-standalone id="bannerImage" label="تصویر پسزمینه*" :file="$bannerImage" type="image" required="true" wire:model="bannerImage"/>
                    <x-admin.forms.input type="url" id="bannerLink" label="لینک مورد نظر" wire:model.defer.defer="bannerLink"/>
                @endif
            </x-admin.modal-page>
        </div>
    </div>
</div>
