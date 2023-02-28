<div>
    @section('title',' کامنت ها ')
    <x-teacher.form-control store="{{false}}" title="کامنت ها"/>
    <div class="card card-custom">
        <div class="card-body">
            <div class="row ">
                <div class="col-12 p-0 m-0">
                    @foreach($data['status'] as $key => $item)
                        <button class="btn btn-link" wire:click="$set('status','{{$key}}')">{{ $item }}</button>
                    @endforeach
                </div>
            </div>
            @include('teacher.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> دیدگاه</th>
                            <th>وضعیت</th>
                            <th>دوره اموزشی</th>
                            <th>متن</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($comments as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ is_null($item->parent_id) ? 'دیدگاه اصلی' : 'ارسال پاسخ' }}</td>
                                <td>{{ $item->status_label }}</td>
                                <td>{{ $item->commentable_data['title'] ?? '' }}</td>
                                <td style="width: 40%;">{!!  $item->content !!}</td>
                                <td>
                                    <x-teacher.edit-btn href="{{ route('teacher.store.comments',['edit', $item->id]) }}" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="10">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{$comments->links('teacher.layouts.paginate')}}
        </div>
    </div>
</div>

