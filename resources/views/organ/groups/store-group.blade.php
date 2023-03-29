<div>
    @section('title','گروه')
    <x-organ.form-control deleteAble="true" deleteContent="حذف گروه" mode="{{$mode}}" title="گروه" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-organ.forms.validation-errors />
        <div class="card-body">
            <div class="row">
                <x-organ.forms.input with="6" type="text" id="title" label="عنوان *" wire:model.defer="title" />
                <x-organ.forms.select2 id="course" :data="$data['course']" label=" دوره اموزشی"
                                       wire:model="course" />
                <x-organ.forms.text-area label="توضیحات" wire:model.defer="description" id="description" />

            </div>
            @if(sizeof($details) > 0)
                @include('organ.layouts.advance-table')
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table class="table  table-bordered" id="kt_datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>دانش اموز</th>
                                <th>انتخاب</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($details as $order)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$order->order->user->name}}</td>
                                    <td>
                                        <div class="form-check text-center">
                                            <input class="form-check-input" type="checkbox" name="{{$order->order->user_id}}" value="{{$order->order->user_id}}" id="user{{$order->id}}"  wire:model="users" >
                                            <label style="cursor: pointer" class="form-check-label mt-1" for="user{{$order->id}}">انتخاب</label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{$details->links('organ.layouts.paginate')}}
            @endif

        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف گروه  !',
                text: 'آیا از حذف این گروه اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                @this.call('deleteItem', id)
                }
            })
        }
    </script>
@endpush
R
