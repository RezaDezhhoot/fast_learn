<div>
    @section('title','امار سوالات')
    <x-admin.form-control :store="false" mode="{{$mode}}" title="امار سوالات"/>

    <div class="card card-custom">
        <div class="card-body">
            <div class="row">
                <x-admin.forms.dropdown with="6" id="category" :data="$data['category']" label="دسته بندی" wire:model="category"/>
                <x-admin.forms.dropdown with="6" id="answer" :data="$data['answer']" label="مرتبط سازی" wire:model="answer"/>
                <x-admin.forms.select2 id="course" :data="$data['course']" label="فیلتر بر حسب دوره اموزشی" wire:model.defer="course"/>

                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام </th>
                            <th>منبع</th>
                            <th>سطح</th>
                            <th>نوع سوال</th>
                            <th>دسته</th>
                            <th>پاسخ های صحیح</th>
                            <th>پاسخ های غلط</th>
                            <th>نمره</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->source }}</td>
                                <td>{{ $item->difficulty_label }}</td>
                                <td>{{ $item->type_label }}</td>
                                <td>{{ $item->category->title ?? '' }}</td>
                                <td>{{ $item->correct_answers }}</td>
                                <td>{{ $item->incorrect_answers }}</td>
                                <td>{{ $item->score }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.question',['edit', $item->id]) }}" />
                                    <x-admin.delete-btn onclick="deleteItem({{$item->id}})" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="15">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{$items->links('admin.layouts.paginate')}}
            </div>
        </div>
    </div>
</div>
