<div>
    @section('title',' فرم ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف فرم" mode="{{$mode}}" title="فرم" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                @if($formModel)
                    <div class="form-control m-3">
                        <a href="{{route('form',$formModel->id)}}">مشاهده فرم</a>
                    </div>
                @endif
                <x-admin.forms.input with="4" type="text" id="name" label="عنوان*" wire:model.defer="name"/>
                <x-admin.forms.dropdown with="4" id="subject" :data="$data['subject']" label="موضوع*" wire:model.defer="subject"/>
                <x-admin.forms.dropdown with="4" id="storage" :data="$data['storage']" label="فضای ذخیره سازی فایل های ارسالی" wire:model.defer="storage"/>
                <x-admin.forms.dropdown id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
            </div>
            <x-admin.form-section label="فیلد های مورد نیاز برای اطلاعات">
                <button class="btn btn-link" wire:click="addForm('select')">لیست</button>
                <button class="btn btn-link" wire:click="addForm('text')">متن</button>
                <button class="btn btn-link" wire:click="addForm('textArea')">باکس متن</button>
                <button class="btn btn-link" wire:click="addForm('customRadio')">گزینه ای</button>
                <button class="btn btn-link" wire:click="addForm('file')">فایل</button>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>نوع</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody wire:sortable="updateFormPosition()">
                    @forelse($form as $key => $item)
                        <tr wire:sortable.item="{{ $item['name'] }}" wire:key="{{ $item['name'] }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{!! $item['label'] ?? ''!!}</td>
                            <td>{{ $item['type']}}</td>
                            <td>
                                <button type="button" wire:click="editForm({{$key}})" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2">
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
                                <x-admin.delete-btn onclick="deleteFormItem({{$key}})" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="4">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </x-admin.form-section>
            <x-admin.modal-page id="text" title="text" wire:click="setFormData()">
                <x-admin.forms.validation-errors/>
                <x-admin.forms.input type="text" id="text-name" label="نام*" wire:model.defer="formName" disabled/>
                <x-admin.forms.dropdown id="text-required" label="اجباری*" :data="['0' => 'خیر', '1' => 'بله']" wire:model.defer="formRequired"/>
                <x-admin.forms.dropdown id="text-width" label="عرض*" :data="['6' => '50 درصد', '12' => '100 درصد']"  wire:model.defer="formWidth"/>
                <x-admin.forms.full-text-editor id="text" label="برچسب فیلد*" wire:model.defer="formLabel"/>
                <x-admin.forms.input type="text" id="text-placeholder" label="متن پیشفرض" wire:model.defer="formPlaceholder"/>
                <x-admin.forms.input type="text" id="text-value" label="مقدار" wire:model.defer="formValue"/>
            </x-admin.modal-page>
            <x-admin.modal-page id="file" title="file" wire:click="setFormData()">
                <x-admin.forms.validation-errors/>
                <x-admin.forms.input type="text" id="text-name" label="نام*" wire:model.defer="formName" disabled/>
                <x-admin.forms.dropdown id="text-required" label="اجباری*" :data="['0' => 'خیر', '1' => 'بله']" wire:model.defer="formRequired"/>
                <x-admin.forms.dropdown id="text-width" label="عرض*" :data="['6' => '50 درصد', '12' => '100 درصد']"  wire:model.defer="formWidth"/>
                <x-admin.forms.full-text-editor id="text" label="برچسب فیلد*" wire:model.defer="formLabel"/>
            </x-admin.modal-page>
            <x-admin.modal-page id="select" title="select" wire:click="setFormData()">
                <x-admin.forms.validation-errors/>
                <x-admin.forms.input type="text" id="select-name" label="نام*" wire:model.defer="formName" disabled/>
                <x-admin.forms.dropdown id="select-required" label="اجباری*" :data="['0' => 'خیر', '1' => 'بله']" wire:model.defer="formRequired"/>
                <x-admin.forms.dropdown id="select-width" label="عرض*" :data="['6' => '50 درصد', '12' => '100 درصد']"  wire:model.defer="formWidth"/>
                <x-admin.forms.full-text-editor id="select" label="برچسب فیلد*" wire:model.defer="formLabel"/>
                <x-admin.forms.input type="text" id="select-value" label="مقدار" wire:model.defer="formValue"/>
                <x-admin.forms.form-options :options="$formOptions ?? []" :formKey="$formKey"/>
            </x-admin.modal-page>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف فرم!',
                text: 'آیا از حذف این فرم اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                @this.call('deleteItem', id)
                }
            })
        }
        function deleteFormItem(id) {
            Swal.fire({
                title: 'حذف فرم!',
                text: 'آیا از حذف فرم اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                @this.call('deleteForm', id)
                }
            })
        }
    </script>
@endpush
