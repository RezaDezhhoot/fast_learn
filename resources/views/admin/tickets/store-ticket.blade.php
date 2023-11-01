<div>
    @section('title',' تیکت ')
    <x-admin.form-control deleteAble="true"  deleteContent="حذف تیکت" mode="{{$mode}}" title="تیکت" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.dropdown with="6" id="subject" value="true" :data="$data['subject']" label="موضوع*" wire:model.defer="subject"/>
                @if($mode == self::UPDATE_MODE)
                    <x-admin.forms.dropdown with="6"  id="status" disabled :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
                @endif
                <x-admin.forms.dropdown with="6" id="priority"  :data="$data['priority']" label="اولویت*" wire:model.defer="priority"/>
                @if($mode == self::CREATE_MODE)
                    <x-admin.forms.searchable-dropdown placeholder="شماره همراه | نام | ایمیل کاربر" with="12" id="name" fn="searchUser" :data="$data['users']" label="کاربر*" wire:model.defer="user"/>
                @endif
            </div>
            <hr>
            <x-admin.forms.full-text-editor id="content" label="متن اصلی*" wire:model.defer="content"/>
            @if($mode == self::CREATE_MODE)
                <x-admin.forms.lfm-standalone id="main_file" label="فایل" :file="$main_file" type="image" required="true" wire:model="main_file"/>
            @else
                @if(!empty($file))
                    <div class="form-group col-12">
                        <h5>فایل ها :</h5>
                        <div class="">
                            @foreach($file as $item)
                                <strong class="d-block">
                                    <a target="_blank" href="{{ asset($item) }}">مشاهده</a>
                                </strong>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
            @if($mode == self::UPDATE_MODE)
                <x-admin.form-section label="کاربر">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>کد کاربر</th>
                                    <td>نام</td>
                                    <td>شماره همراه</td>
                                    <td>وضعیت</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $ticket->user->id }}</td>
                                    <td>{{ $ticket->user->name }}</td>
                                    <td>{{ $ticket->user->phone }}</td>
                                    <td>{{ $ticket->user->status_label }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </x-admin.form-section>
                <x-admin.form-section label="تاریخچه گفتگو">
                    <x-chat-panel :chats="$child" :multiple="false" file_label="file" :file="$file" sender="sender_id" message="content" />
                </x-admin.form-section>
            @endif
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف تیکت  !',
                text: 'آیا از حذف این تیکت   اطمینان دارید؟',
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
                            'تیکت   مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteItem', id)
                }
            })
        }
    </script>
@endpush
