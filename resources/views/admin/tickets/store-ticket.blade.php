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
                    <x-admin.forms.dropdown with="6" id="status" disabled :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
                @endif
                <x-admin.forms.dropdown with="6" id="priority"  :data="$data['priority']" label="اولویت*" wire:model.defer="priority"/>
                <x-admin.forms.input with="6" type="text" id="user" label="شماره همراه کاربر*" wire:model.defer="user"/>
            </div>
            <hr>
            <x-admin.forms.full-text-editor id="content" label="متن اصلی*" wire:model.defer="content"/>
            <x-admin.forms.lfm-standalone id="file" label="فایل" :file="$file" type="image" required="true" wire:model="file"/>
            @if($mode == self::UPDATE_MODE)
                <x-admin.form-section label="تاریخچه گفتگو">
                    @foreach($child as $key =>  $item)
                        <div class="col-lg-12 border px-4 py-3 d-flex align-items-center justify-content-between" style="border: 1px gray solid;padding: 5px;border-radius: 5px;margin: 10px">
                            <div>
                                <h5 class="text-info">
                                    {{ $item->sender->name }} :
                                </h5>
                                <p>
                                    {!! $item->content !!}
                                </p>
                                <small class="text-warning">{{ $item->date }}</small>
                                @if(!empty($item->file))
                                    <p>
                                        <label for="">فایل</label>
                                        @foreach(explode(',',$item->file) as $value)
                                            <a class="btn btn-link" href="{{ asset($value) }}">مشاهده</a>
                                        @endforeach
                                    </p>
                                @endif
                            </div>
                            <div>
                                <button class="btn btn-light-danger font-weight-bolder btn-sm mx-3r" wire:click="delete({{$key}})">حذف</button>
                            </div>
                        </div>
                    @endforeach
                </x-admin.form-section>
                <x-admin.form-section label="ارسال پاسخ">
                    <x-admin.forms.full-text-editor id="answer" label="" wire:model.defer="answer"/>
                    <x-admin.forms.lfm-standalone id="answerFile" label="فایل" :file="$answerFile" type="image" required="true" wire:model="answerFile"/>
                    <x-admin.button class="btn btn-light-primary font-weight-bolder btn-sm" content="ثبت" wire:click="newAnswer()" />
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
