<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5 d-flex align-items-center justify-content-between">
            <h3 class="fs-22 font-weight-semi-bold">تمرین های ارسالی </h3>
        </div>
        <div style="overflow-x:auto;" class="dashboard-cards mb-5">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>#</td>
                    <td>دوره اموزشی</td>
                    <td>عنوان درس</td>
                    <td>بررسی توسط مدرس</td>
                    <td>تاریخ</td>
                    <td>مشاهده جزئیات</td>
                </tr>
                </thead>
                <tbody>
                    @forelse($homeworks as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->episode->course->title ?? '' }}</td>
                            <td>{{ $item->episode_title }}</td>
                            <td>{{ !is_null($item->result) ? 'بله' : 'خیر' }}</td>
                            <td>{{ $item->created_at->diffForHumans() }}</td>
                            <td>
                                <p wire:click="homework('{{$item->id}}')" data-toggle="modal" data-target="#homeworkModal" class="d-flex align-items-center cursor-pointers">
                                     مشاهده <i class="la la-eye px-2 la-lg"></i>
                                </p>
                            </td>
                        </tr>
                    @empty
                        <td class="text-center alert alert-info" colspan="6">
                            هیج درخواست پشتیبانی ای ثبت نشده است.
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div wire:ignore.self class="modal fade modal-container" id="homeworkModal" tabindex="-1" role="dialog" aria-labelledby="homeworkModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-gray d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">ارسال تمرین</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="نزدیک">
                            <span aria-hidden="true" class="la la-times"></span>
                        </button>
                    </div>
                    <div>
                        @if(!is_null($homework) && is_null($homework->result))
                            <button class="btn btn-sm btn-outline-danger" onclick="delete_homework()"><i class="la la-trash"></i> حذف این تمرین</button>
                        @endif
                    </div>
                </div>
                <div class="modal-body">
                    @if($show_homework_form)
                        <form>
                            <div class="row">
                                @auth
                                    <div class="input-box col-12">
                                        <div class="form-group">
                                            <div x-data="{ isUploading: false, progress: 0 }"
                                                 x-on:livewire-upload-start="isUploading = true"
                                                 x-on:livewire-upload-finish="isUploading = false"
                                                 x-on:livewire-upload-error="isUploading = false"
                                                 x-on:livewire-upload-progress="progress = $event.detail.progress" class="custom-file my-4">
                                                <input disabled type="file" class="custom-file-input" wire:model="homework_file" id="homework_file">
                                                <label class="custom-file-label"  for="homework_file">انتخاب فایل</label>
                                                <div class="mt-2" x-show="isUploading">
                                                    در حال اپلود فایل...
                                                    <progress max="100" x-bind:value="progress"></progress>
                                                </div>
                                                <small class="text-info">حداقل حجم مجاز : 2 مگابایت</small>
                                                <small class="text-info">jpg,jpeg,png,pdf,zip,rar</small>
                                                @if(!is_null($homework) && !is_null($homework->file))
                                                    <small class="alert d-block p-1 alert-success">فایل ارسال شده است</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-box col-lg-12">
                                        <label class="label-text">توضیحات</label>
                                        <div class="form-group">
                                            <textarea disabled wire:model.defer="homework_description" class="form-control form--control pl-3" name="homework_description" placeholder="توضیحات" rows="5"></textarea>
                                        </div>
                                    </div>
                                    @if(!is_null($homework) && !is_null($homework->result))
                                        <div class="col-12">
                                            <h6>نتیجه :</h6>
                                            <small>
                                                @for($i=1; $i<=5; $i++)
                                                    @if($i <= $homework->score)
                                                        <span class="la la-star"></span>
                                                    @else
                                                        <span class="la la-star-o"></span>
                                                    @endif
                                                @endfor
                                            </small>
                                            <p class="mr-1">
                                                {!! $homework->result !!}
                                            </p>
                                        </div>
                                    @endif
                                @else
                                    <p class="text-info">
                                        برای ارسال تمرین ابتدا ثبت نام کنید
                                    </p>
                                @endif
                            </div>
                        </form>
                    @else
                        <p class="alert alert-danger">شما به این بخش دسترسی ندارید.</p>
                    @endif
                </div>
                <div class="modal-footer justify-content-center border-top-gray">

                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        function delete_homework() {
            Swal.fire({
                title: 'حذف تمرین!',
                text: 'آیا از حذف این تمرین اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                @this.call('delete_homework')
                }
            })
        }
    </script>
@endpush
