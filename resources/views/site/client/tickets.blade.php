<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5 d-flex align-items-center justify-content-between">
            <h3 class="fs-22 font-weight-semi-bold">پشتیبانی </h3>
            <a href="{{ route('user.ticket',['create']) }}" class="btn btn-outline-primary ">درخواست جدید</a>
        </div>
        <div style="overflow-x:auto;" class="dashboard-cards mb-5">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>#</td>
                    <td>موضوع</td>
                    <td>وضعیت</td>
                    <td>اولویت</td>
                    <td>تاریخ</td>
                    <td>عمیلات</td>
                </tr>
                </thead>
                <tbody>
                @forelse($tickets as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->subject }}</td>
                        <td>{{ $item->status_label }}</td>
                        <td>{{ $item->priority_label }}</td>
                        <td>{{ $item->date }}</td>
                        <td><a href="{{ route('user.ticket',['edit',$item->id]) }}"> مشاهده </a></td>
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
</div>
