<div>
    @section('title','درخواست مدرس ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف درخواست" mode="{{$mode}}" title="درخواست مدرس "/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row pb-4">
                <div class="col-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>کد کاربر</th>
                            <td>نام</td>
                            <td>شماره همراه</td>
                            <td>وضعیت</td>
                            <td>ای پی کاربر</td>
                            <th>مشاهده لاگ ها</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $request->user->id }}</td>
                            <td>{{ $request->user->name }}</td>
                            <td>{{ $request->user->phone }}</td>
                            <td>{{ $request->user->status_label }}</td>
                            <td>{{ $request->user->ip }}</td>
                            <td>
                                <a title="مشاهده لاگ این کاربر" href="{{route('admin.log',['user'=>$request->user->id])}}">مشاهده</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                @if(!is_null($url))
                    <div class="col-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <td>ادرس رزومه/لینک</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><a href="{{ $url }}">{{ $url }}</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="col-12">
                   <fieldset class="border p-4">
                       <legend class="font-size-h6">شرح درخواست</legend>
                       {!! $descriptions !!}
                   </fieldset>
                </div>
                @if(!empty($files))
                <div class="col-12">
                    <fieldset class="border p-4">
                        <legend>فایل ها</legend>
                        @foreach($files as $item)
                            <strong class="d-block">
                                <button class="btn btn-sm btn-success" wire:click="download('{{$item}}')">دانلود</button>
                            </strong>
                        @endforeach
                    </fieldset>
                </div>
                @endif
            </div>
            <x-admin.forms.dropdown  id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
            <x-admin.forms.full-text-editor id="result" label="نتیجه نهایی*" wire:model.defer="result"/>
        </div>

    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف درخواست!',
                text: 'آیا از حذف این درخواست اطمینان دارید؟',
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
