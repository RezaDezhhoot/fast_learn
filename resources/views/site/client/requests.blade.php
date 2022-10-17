<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold">
                درخواست های همکاری من
            </h3>
        </div>
        <div class="dashboard-cards mb-5">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>#</td>
                    <td>تاریخ</td>
                    <td>وضعیت</td>
                    <td>مشاهده جزئیات</td>
                </tr>
                </thead>
                <tbody>
                @forelse($requests as $key =>  $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->status_label }}</td>
                        <td>
                            <p wire:click="show_details('{{$key}}')" data-toggle="modal" data-target="#show_details" class="d-flex align-items-center cursor-pointers">
                                مشاهده<i class="la la-eye px-2 la-lg"></i>
                            </p>
                        </td>
                    </tr>
                @empty
                    <td class="text-center alert alert-info" colspan="6">
                        هیج درخواستی ثبت نشده است.
                    </td>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div wire:ignore.self class="modal fade modal-container" id="show_details" tabindex="-1" role="dialog" aria-labelledby="show_detailsTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-gray d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">نتیجه درخواست همکاری شما : </h5>
                    </div>
                </div>
                <div class="modal-body">
                    @if(!empty($result))
                        {!! $result !!}
                    @else
                        <p class="text-info">نتیجه ای ثبت نشده است</p>
                    @endif
                </div>
                <div class="modal-footer justify-content-center border-top-gray">

                </div>
            </div>
        </div>
    </div>
</div>
