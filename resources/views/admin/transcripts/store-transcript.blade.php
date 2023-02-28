<div>
    @section('title','کارنامه  ')
    <x-admin.form-control deleteAble="true"  deleteContent="حذف کارنامه" mode="{{$mode}}" title="کارنامه" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card card-custom"   >
            <div class="card-body p-0">
                @if($mode == self::UPDATE_MODE)
                <!--begin::Invoice-->
                <!--begin::Invoice header-->
                <div class="container">
                    <div class="card card-custom card-shadowless">
                        <div class="card-body p-0">
                            <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                                <div class="col-md-9">
                                    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
                                        <div class="d-flex flex-column px-0 order-2 order-md-1 align-items-center align-items-md-start">
                                            <span class="d-flex flex-column font-size-h5 font-weight-bold text-muted align-items-center align-items-md-start">
                                                <span>{{$transcript->quiz->name}}</span>
                                                <span>{{$transcript->date}}</span>
                                            </span>
                                        </div>
                                        <h1 class="display-3 font-weight-boldest order-1 order-md-2 mb-5 mb-md-0">جزئیات</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Invoice header-->
                <!--begin::Invoice Body-->
                <div class="position-relative">
                    <!--begin:Table-->
                    <div class="container ">
                        <x-admin.form-section label="کاربر">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <td>کد کاربر</td>
                                            <td>نام</td>
                                            <td>شماره همراه</td>
                                            <td>وضعیت</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{ $transcript->user->id }}</td>
                                            <td>{{ $transcript->user->name }}</td>
                                            <td>{{ $transcript->user->phone }}</td>
                                            <td>{{ $transcript->user->status_label }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </x-admin.form-section>
                        <div class="row ">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <td >متن سوال :</td>
                                            <td >نمره سوال :</td>
                                            <td >نمره دریافت شد :</td>
                                            <td >جواب درست :</td>
                                            <td >جواب :</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($transcript->answers as $item)
                                            <tr>
                                                <td >{!! str()->limit($item->question_text,$limit = 180, $end = '...') !!}</td>
                                                <td >{{ $item->question_score }}</td>
                                                <td >{{ $item->score_received }}</td>
                                                <td >{{ $item->true_choice_value }}</td>
                                                <td >{{ $item->choice_value }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                        <tr class="font-size-lg font-weight-bolder h-65px">
                                            <td>شماره کارنامه :</td>
                                            <td >
                                                {{ $transcript->id }}
                                            </td>
                                        </tr>
                                        <tr class="font-size-lg font-weight-bolder h-65px">
                                            <td >دوره اموزشی :</td>
                                            <td >{{ $transcript->course_data['title'] ?? '' }}</td>
                                        </tr>
                                        <tr class="font-size-lg font-weight-bolder h-65px">
                                            <td>گواهینامه ازمون :</td>
                                            <td>{{  $transcript->quiz->certificate->title ?? 'ندارد' }}</td>
                                        </tr>
                                        <tr class="font-size-lg font-weight-bolder h-65px">
                                            <td >نمره نهایی :</td>
                                            <td >{{ $transcript->score }}</td>
                                        </tr>
                                        <tr class="font-size-lg font-weight-bolder h-65px">
                                            <td>نتیجه :</td>
                                            <td >{{ $transcript->result_label }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end:Table-->
                </div>
                @endif
                    <div class="container py-4">
                        @if($mode == self::CREATE_MODE)
                            <div class="row">
                                <x-admin.forms.dropdown with="6" id="quiz" :data="$data['quiz']" label="ازمون*" wire:model.defer="quiz"/>
                                <x-admin.forms.input with="6" type="text" id="user" label="شماره همراه کاربر*" wire:model.defer="user"/>
                                <x-admin.forms.dropdown id="course" :data="$data['course']" label="دوره*" wire:model.defer="course"/>
                            </div>
                        @endif
                        @if($mode == self::UPDATE_MODE)
                            <div class="row">
                                <x-admin.forms.input with="6" type="text" id="certificate_code" label="کد گواهینامه" wire:model.defer="certificate_code"/>
                                <x-admin.forms.jdate-picker sign="/" with="6" with="6" id="certificate_date" label="تاریخ صدور" wire:model.defer="certificate_date"/>
                                <x-admin.forms.input type="number" id="extra_time" help="برحسب دقیقه" label="زمان اضافه" wire:model.defer="extra_time"/>
                            </div>
                        @endif
                    </div>
                <!--end::Invoice Body-->
                <!-- begin: Invoice action-->
                <div class="container py-4">
                    <div class="row">
                        <x-admin.forms.input with="6" type="number" id="score" label="نمره" wire:model.defer="score"/>
                        <x-admin.forms.dropdown with="6" id="result" :data="$data['result']" label="نتیجه*" wire:model.defer="result"/>
                    </div>
                </div>
                    @if($transcript->result == \App\Enums\QuizEnum::ERROR)
                        <div class="col-12 p-4">
                            <fieldset class="border p-4 ">
                                <legend class="font-size-h6">خطای سیستم : </legend>
                                <p class="text-danger">
                                    {{ $transcript->error_message}} }}
                                </p>
                            </fieldset>
                        </div>
                    @endif
                <!-- end: Invoice action-->
                <!--end::Invoice-->
            </div>
        </div>
    </div>
</div>
