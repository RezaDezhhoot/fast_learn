<div>
    @section('title','دفتر حضور غیاب ')
    <x-admin.form-control store="{{false}}" title="دفتر حضور غیاب "/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام مستعار</th>
                            <th>عنوان</th>
                            <th>مشاهده</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($courses as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.rollCall',[$item->id]) }}" />
                                </td>
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
            {{$courses->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
