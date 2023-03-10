<div>
    @section('title','رونوشت های فصل ها ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف رونوشت" mode="{{$mode}}" title="رونوشت" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors />
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>عنوان فصل</th>
                            <th>عنوان دوره</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $chapter->title }}</td>
                            <td>{{ $chapter->course->title }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>نمایش</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$chapter->view}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 my-2">
                    <fieldset class="border p-4">
                        <legend class="font-size-h6">توضیحات مدرس</legend>
                        {!! $description !!}
                    </fieldset>
                </div>
                <x-admin.forms.dropdown  id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
                <x-admin.forms.dropdown  id="status" :data="$data['main_status']" label="وضعیت فصل*" wire:model.defer="main_status"/>
                <x-admin.forms.full-text-editor id="message" label="نتیجه نهایی*" wire:model.defer="message"/>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف رونوشت!',
                text: 'آیا از حذف این رونوشت اطمینان دارید؟',
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
    </script>
@endpush
