<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold">ازمون های من</h3>
        </div>
        <div style="overflow-x:auto;" class="dashboard-cards mb-5">
            @if(!$userDetails)
                <p class="alert alert-warning"><b class="text-danger">توجه</b> : کاربر گرامی قبل از شروع ازمون می بایست پروفایل خود را تکمیل نمایید.
                    <a class="btn-link" href="{{ route('user.profile') }}">تکمیل پروفایل</a>
                </p>
            @endif
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>#</td>
                    <td>ازمون</td>
                    <td>دوره</td>
                    <td>نمره</td>
                    <td>شماره کارنامه</td>
                    <td>عملیات</td>
                </tr>
                </thead>
                <tbody>
                @forelse($transcripts as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <th scope="row">
                            <ul class="generic-list-item">
                                <li>
                                    <span class="badge bg-success text-white p-1"></span>
                                    <span class="badge bg-info text-white p-1">{{ $item->result_label }} </span><span> {{ $item->date }} </span>
                                </li>
                                <li>
                                    <a class="text-black">{{ $item->quiz->name }}</a>
                                </li>
                            </ul>
                        </th>
                        <td>{{ $item->course_data['title'] }}</td>
                        <td>{{ $item->score }}</td>
                        <td>{{ $item->id }}</td>
                        <td><a href="{{ route('user.quiz',$item->id) }}"> {{in_array($item->result,[\App\Enums\QuizEnum::SUSPENDED,\App\Enums\QuizEnum::PENDING]) ? 'ورود به ازمون' : 'مشاهده کارنامه'}} </a></td>
                    </tr>
                @empty
                    <td class="text-center alert alert-info" colspan="7">
                        هیچ ازمونی برای شما فعال نمی باشد.
                    </td>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
