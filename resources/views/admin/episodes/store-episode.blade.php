<div>
    @section('title','درس')
    <x-admin.form-control deleteAble="true" deleteContent="حذف درس" mode="{{$mode}}" title="درس" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" type="text" id="title" label="عنوان *" wire:model.defer="title"/>
                <x-admin.forms.input  with="6" type="url" id="link" label="لینک" wire:model.defer="link"/>
                <x-admin.forms.input  with="6" type="text" id="time" label="زمان *" wire:model.defer="time"/>
                <x-admin.forms.input  with="6"  type="number" id="view" label="نمایش *" wire:model.defer="view"/>
                <x-admin.forms.select2 id="course_id" :data="$data['course']" label=" دوره اموزشی" wire:model.defer="course_id"/>
                <x-admin.forms.checkbox value="1" id="free"  label="رایگان " wire:model.defer="free" />
                <x-admin.forms.text-area label="کد اشتراک گذاریapi " wire:model.defer="api_bucket" id="api_bucket" />
                <table class=" table table-bordered">
                    <tbody>
                    <tr>
                        <td>
                            <x-admin.forms.dropdown id="file_storage" :data="$data['storage']" label="  فضای ذخیره سازی فایل" wire:model.defer="file_storage"/>
                        </td>
                        <td>
                            <x-admin.forms.lfm-standalone id="file" label="فایل" :file="$file" type="image" required="true" wire:model="file"/>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>
                            <x-admin.forms.dropdown id="video_storage" :data="$data['storage']" label=" فضای ذخیره سازی ویدئو" wire:model.defer="video_storage"/>
                        </td>
                        <td>
                            <x-admin.forms.lfm-standalone id="local_video" label="ویدئو" :file="$local_video" type="image" required="true" wire:model="local_video"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <x-admin.forms.checkbox value="1" id="allow_show_local_video"  label="امکان نمایش ویدئو " wire:model.defer="allow_show_local_video" />
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف درس!',
                text: 'آیا از حذف این درس اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'موفیت امیز!',
                            'درس مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteItem', id)
                }
            })
        }
    </script>
@endpush
