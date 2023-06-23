<div wire:init="setTimer()">
    <div class="container-fluid p-0">
        <div class="dashboard-cards">
            <section class="breadcrumb-area">
                <div class="bg-white py-3 pattern-bg">
                    <div class="container">
                        <div class="breadcrumb-content">
                            <ul class="quiz-nav d-flex flex-wrap align-items-center">
                                <li>
                                    <a ><i class="la la-clock mr-2"></i>زمان باقی مانده</a>
                                </li>
                                <li>
                                    <div wire:ignore class="text-right  d-flex align-items-center justify-content-between">
                                        <h5 class="p-1" id="clock"></h5>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- end breadcrumb-content -->
                    </div>
                    <!-- end container -->
                </div>
                <div class="bg-dark pt-60px pb-60px" style="background-color: #0c3800 !important;">
                    <div class="container">
                       
                        <div class="breadcrumb-content">
                            <div class="section-heading">
                                <h2 class="section__title text-white fs-30 pb-2">سوال {{ $page }} از {{ $question_count }}</h2>
                                @foreach($question as $item)
                                    <small style="color:#fff">سطح سوال : {{ $item->difficulty_label }}</small>
                                    <div class="section__desc" style="color:#fff">
                                        {!! $item->text !!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- end container -->
                </div>
                <div class="quiz-action-nav bg-white py-3 shadow-sm">
                    <div class="container">
                        <div class="quiz-action-content d-flex flex-wrap align-items-center justify-content-between">
                            <ul class="quiz-nav d-flex align-items-center">
                                <li><i class="la la-sliders fs-17 mr-2"></i>پاسخ صحیح زیر را انتخاب کنید</li>
                            </ul>
                            <div class="quiz-nav-btns d-flex align-items-center justify-content-between">
                                <button onclick="finish()" wire:loading.attr="disabled" class="btn btn-primary d-inline-flex align-items-center">پایان ازمون <i class="la la-close icon ml-1"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- end container -->
                </div>
                <!-- end quiz-action-nav -->
            </section>

            <section class="quiz-ans-wrap pt-60px">
                <div class="container">
                    <div class="quiz-ans-content">
                        <h3 class="fs-22 font-weight-semi-bold">جواب شما:</h3>
                        <div class="quiz-ans-list py-3">
                            @foreach($question as $item)
                                <div class="col-12">
                                    <div class="row m-0 px-1">
                                        @foreach($item->choices as $choice)
                                            <div class="custom-control custom-checkbox mb-1 p-1 {{ $transcript->quiz->show_choices_type == App\Enums\QuizEnum::SHOW_SIDE_BY_SIDE ? 'col-6 col-sm-3' : 'col-12' }}  ">
                                                <input  wire:model="answers.{{$item->id}}" type="radio" id="{{ $choice->id }}" name="{{ $item->id }}" value="{{ $choice->id }}" class="custom-control-input" />
                                                <label class="custom-control-label custom--control-label" for="{{ $choice->id }}">
                                                    {{ $choice->title }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="py-3">
                                    <button wire:loading.attr="disabled" wire:click="undo({{ $item->id }})" class="btn btn-outline-danger btn-sm">پاک کردن جواب</button>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            {{$question->links('site.includes.paginate-exam')}}
                        </div>
                        <!-- end quiz-ans-list -->
                    </div>
                </div>
                <!-- end container -->
            </section>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function finish() {
            Swal.fire({
                title: 'اتمام ازمون!',
                text: 'آیا از اتمام این ازمون اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                    @this.call('finish')
                    }

                }
            })
        }
        Livewire.on('timer', function (data) {
            $('#clock').countdown(data.data)
                .on('update.countdown', function(event) {
                    var format = '%H:%M:%S';
                    if(event.offset.totalDays > 0) {
                        format = '%-d روز ' + format;
                    }
                    if(event.offset.weeks > 0) {
                        format = '%-w هفته ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function(event) {
                    $(this).html('اتمام زمان!')
                        .parent().addClass('disabled');
                    @this.call('finish')
                });
        })

    </script>
@endpush
