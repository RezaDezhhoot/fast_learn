<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>

    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold">گزارش پیشرفت</h3>
        </div>
        <x-admin.forms.select2 id="course" :data="$data['course']" label="فیلتر بر حسب دوره اموزشی" wire:model="course"/>

        <div style="overflow-x:auto;" class="dashboard-cards mb-5">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان آزمون </th>
                        <th>پاسخ های صحیح</th>
                        <th>پاسخ های غلط</th>
                        <th>تعداد دفعات شرکت در آزمون</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->correct_answers }}</td>
                        <td>{{ $item->incorrect_answers }}</td>
                        <td>{{ $item->results_count }}</td>
                    </tr>
                @empty
                    <td class="text-center" colspan="15">
                        دیتایی جهت نمایش وجود ندارد
                    </td>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
