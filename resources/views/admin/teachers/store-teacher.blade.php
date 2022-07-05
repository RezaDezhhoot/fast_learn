<div>
    @section('title','مدرس ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف مدرس" mode="{{$mode}}" title="مدرس"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input type="text" id="sub_title" label="عنوان *" wire:model.defer="sub_title"/>
                <x-admin.forms.full-text-editor id="body" label="متن*" wire:model.defer="body"/>
                <x-admin.forms.input type="text" wire:input="searchUser" id="user" label="شماره همراه - ادرس ایمیل  *" wire:model="user"/>
            </div>
            <x-admin.loader wire:target="searchUser" text="در حال جستجو" />
            <div class="row">
                @foreach($users as $item)
                    <div wire:click="setUser({{$item['id']}},'{{$item['name']}}')" class="col-1 mx-1 border d-flex align-items-center justify-content-center">
                        <span class="btn btn-link">{{ $item['name'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف مدرس!',
                text: 'آیا از حذف این مدرس اطمینان دارید؟',
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
                            'مدرس مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteItem', id)
                }
            })
        }
    </script>
@endpush
