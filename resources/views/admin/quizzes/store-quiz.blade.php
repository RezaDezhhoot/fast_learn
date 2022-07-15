<div>
    @section('title','ازمون ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف ازمون" mode="{{$mode}}" title="ازمون"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" type="text" id="name" label="نام ازمون*" wire:model.defer="name"/>
                <x-admin.forms.input with="6" type="number" id="time" label="زمان*" help="برحسب دقیقه" wire:model.defer="time"/>
                <x-admin.forms.dropdown with="6" id="accept_type" :data="$data['type']" label="روش محاسبه نمره*" wire:model.defer="accept_type"/>
                <x-admin.forms.input with="6" type="number" id="min_score" label="حداقل نمره قبولی*" help="برحسب درصد یا ثابت" wire:model.defer="min_score"/>
                <x-admin.forms.input with="6" type="number" id="enter_count" label="تعداد دفعات مجاز ورود به ازمون*" wire:model.defer="enter_count"/>
                <x-admin.forms.dropdown with="6" id="certificate" :data="$data['certificate']" label="گواهینامه" wire:model.defer="certificate"/>
                <x-admin.forms.dropdown  id="show_choices_type" :data="$data['show_choices_type']" label="نحوه نمایش گزینه ها*" wire:model.defer="show_choices_type"/>
            </div>
            <hr>
            <x-admin.forms.full-text-editor id="descriptions" label="توضیحات*" wire:model.defer="descriptions"/>
            <x-admin.forms.lfm-standalone id="image" label="تصویر*" :file="$image" type="image" required="true" wire:model="image"/>
            <hr>
            <x-admin.form-section label="سوالات انتخابی">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>نمره</th>
                        <th>منبع</th>
                        <th>دسته</th>
                        <th>سطح</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($selected_questions_list as $key => $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->score}}</td>
                            <td>{{$value->source}}</td>
                            <td>{{$value->category->title}}</td>
                            <td>{{$value->difficulty_label}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="col-12">
                    <p>
                        بارم : {{ $total_score }}
                    </p>
                </div>
            </x-admin.form-section>
            <hr>

            <x-admin.form-section label="سوالات ">
                <div class="border p-3">
                    <x-admin.forms.dropdown id="category" :data="$data['question_categories']" label="دسته سوالات*" wire:model="category"/>
                    <div class="col-12">
                        <p>
                            بارم : {{ $total_score }}
                        </p>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>انتخاب</th>
                            <th>عنوان</th>
                            <th>نمره</th>
                            <th>منبع</th>
                            <th>دسته</th>
                            <th>سطح</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($questions as $key => $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <x-admin.forms.checkbox value="{{$value->id}}" id="{{$key}}ture" label="انتخاب" wire:model="selected_questions.{{$value->id}}" />
                                </td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->score}}</td>
                                <td>{{$value->source}}</td>
                                <td>{{$value->category->title}}</td>
                                <td>{{$value->difficulty_label}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </x-admin.form-section>

        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem() {
            Swal.fire({
                title: 'حذف ازمون!',
                text: 'آیا از حذف این ازمون اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'موفیت امیز!',
                            'ازمون مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteItem', id)
                }
            })
        }
    </script>
@endpush

