<div>
    @section('title','فصل ها ')
    <x-organ.form-control link="{{ route('organ.store.chapters',['create'] ) }}" confirmContent="تعریف فصل جدید"  title="فصل ها "/>
    <div class="card card-custom">
        <div class="card-body">
            <x-organ.nav-tabs-list>
                @foreach($data['tab'] as $key => $value)
                    <x-organ.nav-tabs-item active="{{$tab==$key}}" :title="$value['title']" key="tab" :value="$key" :icon="$value['icon']"/>
                @endforeach
            </x-organ.nav-tabs-list>
            @if($tab == self::CHAPTERS)
                <x-organ.forms.dropdown id="course" :data="$data['course']" label="فیلتر بر حسب دوره اموزشی" wire:model="course"/>
                @include('organ.layouts.advance-table')
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table  class="table table-striped table-bordered" id="kt_datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان فصل</th>
                                <th>عنوان دوره</th>
                                <th>وضعیت</th>
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($chapters as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td> {{ $item->course->title }}</td>
                                    <td> {{ $item->status_label }}</td>
                                    <td>
                                        <x-admin.edit-btn href="{{ route('organ.store.chapters',['action' => 'edit', 'id' => $item->id]) }}" />
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
                @include('organ.layouts.advance-table')
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table  class="table table-striped table-bordered" id="kt_datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان فصل</th>
                                <th>عنوان دوره</th>
                                <th>تاریخ</th>
                                <th>وضعیت</th>
                                <th>مشاهده نتیجه</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($chapters as $item)
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
            {{$chapters->links('organ.layouts.paginate')}}
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
