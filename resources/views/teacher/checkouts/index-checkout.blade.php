<div>
    @section('title','تسویه حساب ها ')
    <x-teacher.form-control link="{{ route('teacher.store.checkouts',['create'] ) }}" confirmContent="تعریف درخواست جدید"  title=" تسویه حساب "/>
    <div class="card card-custom">
        <div class="card-body">
            <x-teacher.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>
            @include('teacher.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>شماره درخواست</th>
                            <th>شماره کارت</th>
                            <th>شماره شبا</th>
                            <th>وضعیت</th>
                            <th>تاریخ</th>
                            <th>مبلغ (تومان)</th>
                            <th>مشاهده جزئیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($checkouts as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->bank_account_info['card_number'] }}</td>
                                <td>{{ $item->bank_account_info['sheba_number'] }}</td>
                                <td>{{ $item->status_label }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ number_format($item->price) }}</td>
                                <td>
                                    <p wire:click="show_details('{{$item->id}}')" data-toggle="modal" data-target="#show_details" class="d-flex align-items-center cursor-pointer">
                                        مشاهده<i class="fa fa-eye px-2 la-lg"></i>
                                    </p>
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="12">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{$checkouts->links('teacher.layouts.paginate')}}
        </div>
    </div>

    <div wire:ignore.self class="modal fade modal-container" id="show_details" tabindex="-1" role="dialog" aria-labelledby="show_detailsTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-gray d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">نتیجه درخواست تسوسیه حساب : </h5>
                    </div>
                </div>
                <div class="modal-body">
                    @if(!empty($result))
                        {!! $result !!}
                    @else
                        <p class="text-info">پیامی ثبت نشده است</p>
                    @endif
                </div>
                <div class="modal-footer justify-content-center border-top-gray">

                </div>
            </div>
        </div>
    </div>
</div>

