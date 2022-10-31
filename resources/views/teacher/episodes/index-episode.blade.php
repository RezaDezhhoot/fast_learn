<div>
    @section('title','درس ها ')
    <x-teacher.form-control link="{{ route('teacher.store.episodes',['create'] ) }}" confirmContent="تعریف درس جدید"  title="درس ها "/>
    <div class="card card-custom">
        <div class="card-body">
            <x-teacher.nav-tabs-list>
                @foreach($data['tab'] as $key => $value)
                    <x-teacher.nav-tabs-item active="{{$tab==$key}}" :title="$value['title']" key="tab" :value="$key" :icon="$value['icon']"/>
                @endforeach
            </x-teacher.nav-tabs-list>
            @if($tab == self::EPISODES)
                <x-teacher.forms.dropdown id="course" :data="$data['course']" label="فیلتر بر حسب دوره اموزشی" wire:model.defer="course"/>
                @include('teacher.layouts.advance-table')
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table  class="table table-striped table-bordered" id="kt_datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان درس</th>
                                <th>عنوان دوره</th>
                                <th>تاریخ انتشار</th>
                                <th>اخرین اپدیت</th>
                                <th>امکان ارسال تمرین</th>
                                <th>تعداد تمرین</th>
                                <th>نقدی/رایگان</th>
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($episodes as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                   <td> {{ $item->course->title }}</td>
                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                    <td>{{ $item->updated_at->diffForHumans() }}</td>
                                    <td>{{ $item->can_homework ? 'دارد' : 'ندارد' }}</td>
                                    <td>{{ $item->homeworks_count }}</td>
                                    <td>{{ $item->free ? 'رایگان' : 'نقدی' }}</td>
                                    <td>
                                        <x-admin.edit-btn href="{{ route('teacher.store.episodes',['edit', $item->id]) }}" />
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
            @elseif($tab == self::TRANSCRIPTS)
                @include('teacher.layouts.advance-table')
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table  class="table table-striped table-bordered" id="kt_datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان درس</th>
                                <th>عنوان دوره</th>
                                <th>تاریخ انتشار</th>
                                <th>وضعیت</th>
                                <th>مشاهده نتیجه</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($episodes as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td> {{ $item->course->title }}</td>
                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                    <td>{{ $item->status_label }}</td>
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
            @endif
            {{$episodes->links('teacher.layouts.paginate')}}
        </div>
    </div>
    <div wire:ignore.self class="modal fade modal-container" id="show_details" tabindex="-1" role="dialog" aria-labelledby="show_detailsTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-gray d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">نتیجه بررسی درس ارسالی شما : </h5>
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
