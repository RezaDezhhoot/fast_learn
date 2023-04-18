<div >
    @section('title',' امار شرکت کننده ها ')
    <x-admin.form-control store="{{false}}"  title="امار شرکت کننده ها" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <div class="card-body" wire:ignore>
            <div class="row" wire:init="loadData">
                @foreach($poll->items as $item)
                    <div class="col-12" >
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="card-header h-auto border-0">
                                <div class="card-title py-5">
                                    <h3 class="card-label">
                                        <span class="d-block text-dark font-weight-bolder">{{ $item['title'] }}</span>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body" >
                                <div id="chart{{$item->id}}"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@push('scripts')
    <script>
        Livewire.on('loadChart', data => {
            let element;
            var options;
            var chart;
            for (let dataKey in data) {
                element = document.getElementById(`chart${dataKey}`);

                    if (!element) {
                        continue;
                    }

                    options = {
                        series: [{
                            name: '',
                            data: data[dataKey]['y']
                        }],
                        chart: {
                            type: 'bar',
                            height: 350,
                            toolbar: {
                                show: false
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: ['30%'],
                                endingShape: 'rounded'
                            },
                        },
                        legend: {
                            show: false
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 1,
                            colors: ['transparent']
                        },
                        xaxis: {
                            categories: data[dataKey]['x'],
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
                        fill: {
                            opacity: 1
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
                                    return  val
                                }
                            }
                        },
                        colors: [KTApp.getSettings()['colors']['theme']['base']['success'], KTApp.getSettings()['colors']['gray']['gray-300']],
                        grid: {
                            borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                            strokeDashArray: 4,
                            yaxis: {
                                lines: {
                                    show: true
                                }
                            }
                        }
                    };

                    chart = new ApexCharts(element, options);
                 chart.render();
            }
            throw '';
        })

    </script>
@endpush
