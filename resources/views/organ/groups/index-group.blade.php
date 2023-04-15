<div>
    @section('title','گروه ها')
    <x-organ.form-control link="{{ route('organ.store.group',['create'] ) }}" title="گروه ها"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-organ.forms.select2 id="course" :data="$data['course']" label="فیلتر بر حسب دوره اموزشی" wire:model.defer="course"/>
            @include('organ.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>شماره شناسه</th>
                            <th>عنوان</th>
                            <th>دوره اموزشی</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->course->title ?? '-' }}</td>
                                <td>
                                    <x-organ.edit-btn href="{{ route('organ.store.group',['edit', $item->id]) }}" />
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
            {{$items->links('organ.layouts.paginate')}}
        </div>
    </div>
</div>
