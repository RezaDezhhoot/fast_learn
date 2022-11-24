<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold"> مشخصات ازمون {{ $transcript->quiz->name }}</h3>
        </div>
        <div class="dashboard-cards mb-5">
            @if(!$userDetails)
                <p class="alert alert-warning"><b class="text-danger">توجه</b> : کاربر گرامی قبل از شروع ازمون می بایست پروفایل خود را تکمیل نمایید.
                    <a class="btn-link" href="{{ route('user.profile') }}">تکمیل پروفایل</a>
                </p>
            @endif
            <div class="row px-1">
                <div class="col-md-12 col-12 bg-white">
                    <div class="row">
                        <div  style="overflow-x:auto;"  class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <td>عنوان ازمون</td>
                                    <td>{{ $transcript->quiz->name }}</td>
                                </tr>
                                <tr>
                                    <td>گواهینامه ازمون</td>
                                    <td>{{  $transcript->quiz->certificate->title ?? 'ندارد' }}</td>
                                </tr>
                                <tr>
                                    <td>حداقل نمره قبولی </td>
                                    <td>{{   $transcript->quiz->minimum_score }}</td>
                                </tr>
                                <tr>
                                    <td>بارم </td>
                                    <td>{{   $transcript->quiz->total_score }}</td>
                                </tr>
                                <tr>
                                    <td>وضعیت </td>
                                    <td>{{   $transcript->result_label }}</td>
                                </tr>
                                @if($transcript->result == \App\Enums\QuizEnum::PENDING || $transcript->result == \App\Enums\QuizEnum::SUSPENDED)
                                    <td colspan="2"><button class="btn btn-outline-primary mt-2 btn-sm d-flex align-items-center" onclick="enter_quiz()">شرکت در ازمون <i class="la la-door-open"></i></button></td>
                                @else
                                    <td colspan="2">کارنامه</td>
                                    <tr>
                                        <td >شماره :</td>
                                        <td >
                                            {{ $transcript->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >مجموع نمرات :</td>
                                        <td >{{ $transcript->answers->map(function ($item , $total){
                                                return $item->question_score; })->sum()
                                        }}</td>
                                    </tr>
                                    <tr>
                                        <td >دوره اموزشی :</td>
                                        <td >{{ $transcript->course_data['title'] ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td >تاریخ :</td>
                                        <td >{{ $transcript->date  }}</td>
                                    </tr>
                                    <tr>
                                        <td >نمره نهایی :</td>
                                        <td >{{ $transcript->score }}</td>
                                    </tr>
                                    <tr>
                                        <td>نتیجه :</td>
                                        <td >{{ $transcript->result_label }}</td>
                                    </tr>
                                    @if($transcript->certificate)
                                        <tr>
                                            <td>گواهینامه :</td>
                                            <td ><a href="{{ route('user.certificate',$transcript->certificate->id) }}">{{ $transcript->certificate->certificate->name }}</a></td>
                                        </tr>
                                    @endif
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function enter_quiz() {
            Swal.fire({
                title: 'ورود به ازمون!',
                text: 'آیا از ورود به این ازمون اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        @this.call('enter_quiz')
                    }

                }
            })
        }
    </script>
@endpush
