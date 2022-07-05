<div>
    @section('title','گواهینامه ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف گواهینامه" mode="{{$mode}}" title="گواهینامه"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" type="text" id="name" label="عنوان *" wire:model.defer="name"/>
                <x-admin.forms.input with="6" type="text" id="title" label="اموزشگاه *" wire:model.defer="title"/>
            </div>
            <hr>
            @if($mode == self::UPDATE_MODE)
                <a class="btn btn-link" href="{{ route('user.certificate',[$demo->id,'status' => 'demo']) }}">مشاهده نمونه</a>
            <hr>
            @endif
            <x-admin.forms.lfm-standalone id="logo" label="لوگو" :file="$logo" type="image" required="true" wire:model="logo"/>
            <x-admin.forms.lfm-standalone id="bg_image" label="تصویر پس زمینه" :file="$bg_image" type="image" required="true" wire:model="bg_image"/>
            <x-admin.forms.lfm-standalone id="autograph_image" label="تصویر مهر و امضا" :file="$autograph_image" type="image" required="true" wire:model="autograph_image"/>
            <x-admin.forms.lfm-standalone id="border_image" label="تصویر قاب" :file="$border_image" type="image" required="true" wire:model="border_image"/>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف گواهینامه!',
                text: 'آیا از حذف این گواهینامه اطمینان دارید؟',
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
                            'گواهینامه مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteItem', id)
                }
            })
        }
    </script>
@endpush
