<div>
    @section('title','دوره ها ')
    <x-teacher.form-control link="{{ route('teacher.new.courses',['create'] ) }}" confirmContent="شروع یک دوره جدید"  title="دوره ها "/>
    <div class="card card-custom">
        <div class="card-body">
            <x-teacher.nav-tabs-list>
                @foreach($data['tab'] as $key => $value)
                    <x-teacher.nav-tabs-item active="{{$tab==$key}}" :title="$value['title']" key="tab" :value="$key" :icon="$value['icon']"/>
                @endforeach
            </x-teacher.nav-tabs-list>

        @if($tab == self::COURSE)
            <x-teacher.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>
            <x-teacher.forms.dropdown id="level" :data="$data['level']" label="سطح" wire:model="level"/>
            @include('teacher.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>شماره شناسه</th>
                            <th>عنوان</th>
                            <th>وضعیت</th>
                            <th>نوع دوره</th>
                            <th>بازدید</th>
                            <th>درس ها</th>
                            <th>دسته </th>
                            <th>قیمت </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($courses as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->status_label }}</td>
                                <td>{{ $item->type_label }}</td>
                                <td>{{ $item->views }}</td>
                                <td>{{ $item->episodes_count }}</td>
                                <td>{{ $item->category->title ?? null }}</td>
                                <td>{{ number_format($item->price) }} تومان </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="11">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{$courses->links('teacher.layouts.paginate')}}
            @else
                <x-teacher.forms.dropdown id="new_status" :data="$data['new_status']" label="وضعیت" wire:model="new_status"/>
                @include('teacher.layouts.advance-table')
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table class="table table-striped table-bordered" id="kt_datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان دوره</th>
                                <th>سطح دوره</th>
                                <th>وضعیت</th>
                                <th>تاریخ</th>
                                <td>مشاهده پیام</td>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($courses as $key => $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="cursor-pointer">
                                        <a title="مشاده جزیئیات" href="{{route('teacher.new.courses',['edit',$item->id])}}">{{ $item->title }}</a>
                                    </td>
                                    <td>{{ $item->level_label }}</td>
                                    <td>{{ $item->status_label }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <p wire:click="show_details('{{$item->id}}')" data-toggle="modal" data-target="#show_details" class="d-flex align-items-center cursor-pointer">
                                            مشاهده<i class="fa fa-eye px-2 la-lg"></i>
                                        </p>
                                    </td>
                                </tr>
                            @empty
                                <td class="text-center" colspan="13">
                                    دیتایی جهت نمایش وجود ندارد
                                </td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{$courses->links('teacher.layouts.paginate')}}
            @endif
        </div>
    </div>
    <div wire:ignore.self class="modal fade modal-container" id="show_details" tabindex="-1" role="dialog" aria-labelledby="show_detailsTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-gray d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">پیام کوتاه درخواست همکاری شما : </h5>
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
