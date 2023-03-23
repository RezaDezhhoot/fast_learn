<div>
    @section('title','دفتر حضور غیاب ')
    <x-organ.form-control store="{{false}}" title="دفتر حضور غیاب "/>
    <div class="card card-custom">
        <div class="card-body">
            @include('organ.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>مشاهده</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($courses as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <x-organ.edit-btn href="{{ route('organ.store.rollCall',[$item->id]) }}" />
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
            {{$courses->links('organ.layouts.paginate')}}
        </div>
    </div>
</div>
