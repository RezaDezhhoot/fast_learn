<div>
    @section('title','داشبورد')
    <x-teacher.form-control  :store="false"  title="داشبورد"/>

    <div class="card card-custom">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <!--begin::Actions-->
                <p class="m-0">از تاریخ</p>
                <div class="d-flex align-center justify-content-between">
                    <x-teacher.forms.jdate-picker id="date" label=""   wire:model.defer="from_date_view"/>
                </div>
                <p class="m-0">تا تاریخ</p>
                <div>
                    <x-teacher.forms.jdate-picker id="date2" label=""  wire:model.defer="to_date_viwe"/>
                </div>
                <div>
                    <button wire:loading.attr="disabled" class="btn btn-light-primary font-weight-bolder btn-sm" wire:click.prevent="confirmFilter">اعمال فیلتر</button>
                </div>
                <!--end::Actions-->
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3 col-6">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-primary card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-info svg-icon-4x">
                                <i class="text-info fab fa-product-hunt fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ $box['courses'] }} عدد
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">دوره های اموزشی</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>

                <div class="col-md-3 col-6">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-success card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-success svg-icon-4x">
                                <i class="text-danger flaticon2-open-text-book fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ $box['episodes'] }}عدد
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">درس ها</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>

                <div class="col-md-3 col-6">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-primary card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-info svg-icon-4x">
                                <i class="text-info fas fa-circle-notch fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ $box['pending_course'] }} عدد
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">دوره های در حال بررسی</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>

                <div class="col-md-3 col-6">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-success card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-success svg-icon-4x">
                                <i class="text-danger fa fa-graduation-cap fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ $box['students'] }}عدد
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">دانش اموزان</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>
            </div>
            <div class="row" wire:ignore>
                <div class="col-xl-12" wire:init="runChart()">
                    <!--begin::Charts Widget 4-->
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header h-auto border-0">
                            <div class="card-title py-5">
                                <h3 class="card-label">
                                    <span class="d-block text-dark font-weight-bolder"> نمودار واریز حق التدریس بابت دوره های اموزشی</span>
                                </h3>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body">
                            <div id="kt_charts_widget_4_chart2"></div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Charts Widget 4-->
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        Livewire.on('runChart', function (data) {
            const element = document.getElementById("kt_charts_widget_4_chart2");
            if (!element) {
                return;
            }
            const obj = JSON.parse(data);
            const options = {
                series: [{
                    name: 'پرداختی ها',
                    data: <?php echo "obj.payments" ?>
                }],
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: {
                        show: true
                    }
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: obj.label,
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        }
                    },
                    crosshairs: {
                        position: 'front',
                        stroke: {
                            color: KTApp.getSettings()['colors']['theme']['light']['success'],
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: false,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    },
                    y: {
                        formatter: function (val) {
                            return val.toLocaleString() + " تومان"
                        }
                    }
                },
                colors: [
                    KTApp.getSettings()['colors']['theme']['base']['success'],
                ],
                grid: {
                    borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                markers: {
                    colors: [
                        KTApp.getSettings()['colors']['theme']['light']['success'],
                    ],
                    strokeColor: [
                        KTApp.getSettings()['colors']['theme']['light']['success'],
                    ],
                    strokeWidth: 3
                }
            };

            const chart = new ApexCharts(element, options);
            throw chart.render();
        });
    </script>
@endpush
