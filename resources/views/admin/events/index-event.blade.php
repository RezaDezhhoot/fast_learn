<div wire:poll.9s>
    @section('title','رویداد ها')
    <x-admin.form-control link="{{ route('admin.store.event',['create'] ) }}"  title="رویداد ها"/>
    <div class="card card-custom" wire:init='start' >
        <div class="card-body">
            <div class="pt-1">
                <x-admin.loader wire:target="start" text="در حال اماده سازی رویداد ها" />
            </div>
            <x-admin.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>
            @include('admin.layouts.advance-table')
            <div class="col-12 py-4">
                <button wire:loading.attr="disabled" onclick="deleteGroup('jobs')" class="btn btn-outline-danger">پاک سازی رویداد های اماده همه رویداد ها</button>
                <button wire:loading.attr="disabled" onclick="deleteGroup('failed_jobs')" class="btn btn-outline-danger">پاک سازی رویداد های ناموفق رویداد همه ها</button>
            </div>
            <div class="col-12 py-2">
                <span class="text-primary">رویداد های اماده : {{ $jobs }}</span>

                <span  class="px-5 text-danger">رویداد های ناموفق : {{ $failed_jobs }}</span>
            </div>
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>وضعیت</th>
                            <th>تعداد کاربر</th>
                            <th>نوع رویداد</th>
                            <th>مرتب سازی</th>
                            <th>نویسنده</th>
                            <th>نتیجه</th>
                            <th>خطا ها</th>
                            <th>عملیات </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($events as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->status_label }}</td>
                                <td>{{ $item->users_count }}</td>
                                <td>{{ $item->event_label }}</td>
                                <td>{{ $item->order_label }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->result }}</td>
                                <td class="text-left">
                                    @if(!empty($item->errors))
                                        {{ str()->limit($item->errors,$limit = 100 , $end = '...') }}
                                        <button wire:click="downloadsError({{$item->id}})" class="btn btn-sm btn-link">دانلود گزارش خطا</button>
                                    @endif
                                </td>
                                <td>
                                    <x-admin.delete-btn onclick="deleteItem({{$item->id}})" />
                                </td>
                            </tr>
                            <td colspan="11">
                                <div class="d-flex justify-content-between align-items-center px-5 border">
                                    <div>جزئیات رویداد :</div>
                                    <div class="p-4">
                                        <p>اماده : {{ number_format($item->job_count) }}</p>
                                        <button class="btn btn-sm btn-outline-success" wire:click="workSingle({{$item->id}})">شروع پردازش</button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteSingle('{{$item->id}}','job')">پاکسازی</button>
                                    </div>
                                    <div class="p-4">
                                        <p>نا موفق : {{ number_format($item->failed_job_count) }}</p>
                                        <button class="btn btn-sm btn-outline-info" wire:click="retrySingle({{$item->id}})">اماده سازی مجدد</button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteSingle('{{$item->id}}','failed_job')">پاکسازی</button>
                                    </div>
                                    <div>
                                        <x-admin.loader wire:target="workSingle({{$item->id}})" text="در حال پردازش" />
                                    </div>
                                </div>
                            </td>
                        @empty
                            <td class="text-center" colspan="13">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{$events->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف رویداد!',
                text: 'آیا از حذف این رویداد اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                    @this.call('delete', id)
                }
            })
        }
        function deleteGroup(status) {
            Swal.fire({
                title: 'پاک سازی رویداد ها!',
                text: 'آیا از پاک سازی رویداد ها اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                @this.call('deleteGroup', status)
                }
            })
        }

        function deleteSingle(id,status) {
            Swal.fire({
                title: 'پاک سازی رویداد ها!',
                text: 'آیا از پاک سازی رویداد ها اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                @this.call('deleteSingle',id, status)
                }
            })
        }

        Livewire.on('relaod_page', data => {
            location.reload();
        })
    </script>
@endpush
