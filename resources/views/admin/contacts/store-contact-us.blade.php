<div>
    @section('title','ارتباط با ما ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف مورد" mode="{{$mode}}" title="ارتباط با ما" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <x-admin.form-section label="اطلاعات">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <td>نام</td>
                                <td>شماره همراه</td>
                                <td>ادرس ایمیل</td>
                                <td>تاریخ</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $contact->full_name }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->date }}</td>
                            </tr>
                            <td colspan="4">
                                نتیجه : {{ $result }}
                            </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </x-admin.form-section>
            <div class="row">
                <x-admin.forms.dropdown with="6" id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
                <x-admin.forms.dropdown with="6" id="action" :data="$data['action']" label="عملیات*" wire:model.defer="answer_action"/>
                <x-admin.forms.text-area label="متن پاسخ*" wire:model.defer="answer" id="answer" />

            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem() {
            Swal.fire({
                title: 'حذف مورد!',
                text: 'آیا از حذف این مورد اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {

                    @this.call('deleteItem')
                }
            })
        }
    </script>
@endpush
