<div>
    @section('title',' سفارش جدید  ')
    <x-admin.form-control  deleteAble="true" mode="{{$mode}}" title="سفارش"/>
    <div class="card card-custom gutter-b example example-compact">
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            @if ($details->count() > 0)
                <x-admin.forms.input  type="text" id="user_number" disabled label="شماره کاربر *" wire:model.defer="user_number" />
            @else
                <x-admin.forms.input  type="text" id="user_number" label="شماره کاربر *" wire:model.defer="user_number" />
            @endif
            <x-admin.form-section label="سبد خرید">
                <x-admin.button class="btn btn-light-primary font-weight-bolder btn-sm"
                content=" افزودن دوره  " wire:click="addDetails()" />
                <table class="table table-striped table-bordered dt-responsive">
                    <thead>
                        <tr>
                            <td>عنوان</td>
                            <td>هزینه دوره</td>
                            <td>هزینه کیف پول</td>
                            <td>هزینه تخفیف</td>
                            <td>هزینه نهایی</td>
                            <td>عملیات</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($details as $key => $value)
                        <tr>
                            <td>{{ $value['course_title'] }}</td>
                            <td>{{ number_format($value['total_amount']).' تومان' }}</td>
                            <td>{{ number_format($value['wallet_amount']).' تومان' }}</td>
                            <td>{{ number_format($value['reduction_amount']).' تومان' }}</td>
                            <td>{{ number_format($value['final_total_amount']).' تومان' }}</td>
                            <td>
                                <button type="button" wire:click="editDetails('{{$key}}')"
                                    class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2">
                                    <span class="svg-icon svg-icon-md">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) ">
                                                </path>
                                                <path
                                                    d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </button>
                                <x-admin.delete-btn wire:click="deleteDetail({{$key}})" />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="table table-striped table-bordered dt-responsive">
                    <tbody>

                        <tr>
                            <td>هزینه کل کیف پول</td>
                            <td>{{ number_format($details->sum('wallet_amount')) }} تومان</td>
                        </tr>
                        <tr>
                            <td>هزینه کل تخفیف</td>
                            <td>{{ number_format($details->sum('reduction_amount')) }} تومان</td>
                        </tr>
                        <tr>
                            <td>هزینه خام</td>
                            <td>{{ number_format($details->sum('total_amount')) }} تومان</td>
                        </tr>
                        <tr>
                            <td>هزینه تهایی کل</td>
                            <td>{{ number_format($details->sum('final_total_amount')) }} تومان</td>
                        </tr>
                    </tbody>
                </table>
            </x-admin.form-section>

        </div>
    </div>
    <x-admin.modal-page id="details" title="دوره برای سفارش" wire:click="storeDetails">
        <x-admin.forms.validation-errors />
        <x-admin.forms.select2 id="course" :data="$data['course']" label=" *  دوره اموزشی" wire:model="course_id"/>
        <div class="form-group col-12">
            <p class="form-control">
                موجودی کیف پول کاربر (تومان) : {{number_format($user_wallet)}}
            </p>
        </div>
        <x-admin.forms.input type="number" id="wallet" label=" هزینه کیف پول (تومان)" wire:model="wallet" />
        <x-admin.forms.input type="number" id="reduction" label=" هزینه  تخفیف (تومان)" wire:model="reduction" />
        <x-admin.forms.input type="number" id="final_total" label="هزینه نهایی (تومان)" disabled wire:model.defer="final_total" />


    </x-admin.modal-page>
</div>
