<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold">گواهینامه ها</h3>
        </div>
        <div style="overflow-x:auto;" class="dashboard-cards mb-5">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>#</td>
                    <th>شماره گواهینامه</th>
                    <td>عنوان</td>
                    <td>دوره</td>
                    <td>ازمون</td>
                    <td>عملیات</td>
                </tr>
                </thead>
                <tbody>
                @forelse($certificates as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->transcript->certificate_code }}</td>
                        <td>{{ $item->certificate->name }}</td>
                        <td>{{ $item->transcript->course_data['title'] }}</td>
                        <td>{{ $item->transcript->quiz->name }}</td>
                        <td><a href="{{ route('user.certificate',[$item->id,'status' => 'original']) }}"> مشاهده </a></td>
                    </tr>
                @empty
                    <td class="text-center alert alert-info" colspan="6">
                        شما هیچ گواهینامه ای ندارید.
                    </td>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
