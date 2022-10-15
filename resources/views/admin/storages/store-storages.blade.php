<div>
    @section('title','فضا دخیره سازی')
    <x-admin.form-control deleteAble="true" deleteContent="حذف" mode="{{$mode}}" title="فضا دخیره سازی"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" type="text" id="name" label="عنوان *" wire:model.defer="name"/>
                <x-admin.forms.dropdown with="6" id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
                <x-admin.forms.input type="number" help="درصورت خالی گذاشتن بدون محدودیت قرار داده می شود" id="max_file_size" label="حداکثر حجم مجاز اپلود فایل(KB)" wire:model.defer="max_file_size"/>
                <x-admin.forms.text-area id="file_types" label="فرمت فای های مجاز" help="در صورت خالی گذاشتن محدودیتی اعمال نمی شود. فرمت هارا با کاما از هم جدا کنید : png,PNG,zip" wire:model.defer="file_types"/>
                <x-admin.forms.text-area id="description" label="توضیحات" wire:model.defer="description"/>
                @if($mode == self::CREATE_MODE)
                    <x-admin.forms.dropdown id="driver" :data="$data['drivers']" label="درایور*" wire:model="driver"/>
                @else
                    <x-admin.forms.dropdown id="driver" disabled :data="$data['drivers']" label="درایور*" wire:model="driver"/>
                @endif
            </div>
            <x-admin.form-section label="config*">
                @if($driver == App\Enums\StorageEnum::FTP)
                    <div class="row">
                        <x-admin.forms.input with="6" type="text" id="storage_root" placeholder="root" label="root" wire:model.defer="config.root"/>
                        <x-admin.forms.input with="6" type="text" id="storage_host" placeholder="دامنه/ای پی" label="دامنه/ای پی" wire:model.defer="config.host"/>
                        <x-admin.forms.input with="6" type="text" id="storage_username" placeholder="نام کاربری" label="نام کاربری" wire:model.defer="config.username"/>
                        <x-admin.forms.input with="6" type="text" id="storage_password" placeholder="رمزعبور" label="رمزعبور" wire:model.defer="config.password"/>
                        <x-admin.forms.input with="12" type="number" id="storage_port" placeholder="پورت" label="پورت" wire:model.defer="config.port"/>
                        <x-admin.forms.checkbox value="1" id="storage_ssl"  label="ssl" wire:model.defer="config.ssl" />
                    </div>
                @elseif($driver == App\Enums\StorageEnum::SFTP)
                    <div class="row">
                        <x-admin.forms.input with="6" type="text" id="sftp_host" placeholder="host" label="host" wire:model.defer="config.host"/>
                        <x-admin.forms.input with="6" type="text" id="sftp_username" placeholder="username" label="username" wire:model.defer="config.username"/>
                        <x-admin.forms.input with="6" type="text" id="sftp_password" placeholder="password" label="password" wire:model.defer="config.password"/>
                        <x-admin.forms.input with="6" type="text" id="sftp_privateKey" placeholder="private key" label="private key" wire:model.defer="config.privateKey"/>
                        <x-admin.forms.input with="6" type="text" id="sftp_hostFingerprint" placeholder="host fingerprint" label="host fingerprint" wire:model.defer="config.hostFingerprint"/>
                        <x-admin.forms.input with="6" type="number" id="sftp_maxTries" placeholder="max tries" label="max tries" wire:model.defer="config.maxTries"/>
                        <x-admin.forms.input with="6" type="text" id="sftp_passphrase" placeholder="passphrase" label="passphrase" wire:model.defer="config.passphrase"/>
                        <x-admin.forms.input with="6" type="number" id="sftp_port" placeholder="port" label="port" wire:model.defer="config.port"/>
                        <x-admin.forms.input with="12" type="text" id="sftp_root" placeholder="root" label="root" wire:model.defer="config.root"/>
                        <x-admin.forms.checkbox value="1" id="sftp_useAgent"  label="use agent" wire:model.defer="config.useAgent" />
                    </div>
                @endif
            </x-admin.form-section>

        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem() {
            Swal.fire({
                title: 'حذف !',
                text: 'آیا از حذف  اطمینان دارید؟',
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
