<div>
    @section('title','دوره جدید ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف درخواست" mode="{{$mode}}" title="دوره جدید"/>
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
                            <td>{{ $course->user->id }}</td>
                            <td>{{ $course->user->name }}</td>
                            <td>{{ $course->user->phone }}</td>
                            <td>{{ $course->user->status_label }}</td>
                            <td>{{ $course->user->ip }}</td>
                            <td>
                                <a title="مشاهده لاگ این کاربر" href="{{route('admin.log',['user'=>$course->user->id])}}">مشاهده</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td>عنوان دوره اموزشی</td>
                            <td>سطح دوره اموزشی</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$course->title}}</td>
                            <td>{{$course->level_label}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <fieldset class="border p-4">
                        <legend>شرح درخواست</legend>
                        {!! $course->descriptions !!}
                    </fieldset>
                </div>
                @if(!empty($course->files))
                    <div class="col-12">
                        <fieldset class="border p-4">
                            <legend>فایل ها</legend>
                            @foreach($course->files as $item)
                                <strong class="d-block">
                                    <button class="btn btn-sm btn-success" wire:click="download('{{$item}}')">دانلود</button>
                                </strong>
                            @endforeach
                        </fieldset>
                    </div>
                @endif
            </div>
            <x-admin.forms.dropdown  id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
            <x-admin.forms.full-text-editor id="result" label="پاسخ کوتاه" wire:model.defer="result"/>
            <br>
            <x-teacher.form-section label="پاسخ ها">
                <x-chat-panel :chats="$course->chats" :file="$file" />
            </x-teacher.form-section>
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
