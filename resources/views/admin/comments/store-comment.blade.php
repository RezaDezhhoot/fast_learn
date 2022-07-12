<div>
    @section('title',' کامنت ')
    <x-admin.form-control deleteAble="true"  deleteContent="حذف کامنت" mode="{{$mode}}" title="کامنت"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title"><a target="_blank" href="{{route('admin.store.user',['edit',$comment->user->id])}}">{{ $header }}</a></h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" type="text" disabled id="case" label="مورد" wire:model.defer="case"/>
                <x-admin.forms.dropdown with="6" id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
            </div>
            <hr>
            <x-admin.forms.full-text-editor id="content" label="متن اصلی" wire:model.defer="content"/>

            @if(is_null($comment->parent_id))
                <x-admin.form-section label="تاریخپه">
                    <div class="row">
                        @foreach($child as $key =>  $item)
                            <div class="col-lg-12 border" style="border: 1px gray solid;padding: 5px;border-radius: 5px;margin: 10px">
                                <h5>
                                    {{ $item->user->name }}:
                                </h5>
                                <small>
                                    {{ $item->date }}
                                </small>
                                <hr>
                                <p>
                                    " {!! $item->content !!} "

                                </p>
                            </div>
                        @endforeach
                    </div>
                </x-admin.form-section>
                <x-admin.form-section label="ارسال پاسخ">
                    <x-admin.forms.full-text-editor id="answer" label="متن" wire:model.defer="answer"/>
                    <x-admin.button class="primary" content="ثبت" wire:click="newAnswer()" />
                </x-admin.form-section>
            @endif
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف کامنت!',
                text: 'آیا از حذف این کامنت اطمینان دارید؟',
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
                            'کامنت مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteItem', id)
                }
            })
        }
    </script>
@endpush