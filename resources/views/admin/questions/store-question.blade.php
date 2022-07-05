<div xmlns:wire="http://www.w3.org/1999/xhtml">
    @section('title','سوال')
    <x-admin.form-control deleteAble="true" deleteContent="حذف سوال" mode="{{$mode}}" title="طراحی سوال"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" type="text" id="name" label="نام سوال*" wire:model.defer="name"/>
                <x-admin.forms.input with="6" type="number" id="score" label="نمره سوال*" wire:model.defer="score"/>
                <x-admin.forms.input with="6" type="text" id="source" label="منبع سوال" wire:model.defer="source"/>
                <x-admin.forms.dropdown with="6" id="difficulty" :data="$data['difficulty']" label="سطح*" wire:model.defer="difficulty"/>
                <x-admin.forms.dropdown id="category" :data="$data['categories']" label="دسته*" wire:model.defer="category"/>
            </div>
            <hr>
            <x-admin.forms.full-text-editor id="text" label="متن سوال*" wire:model.defer="text"/>
            <hr>
            <x-admin.form-section label="گزینه ها">
                <x-admin.button class="btn btn-light-primary font-weight-bolder btn-sm" content="افزودن گزینه" wire:click="addChoice()" />
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>ضریب نمره مثبت/منفی(برحسب درصد)</th>
                        <th>گزینه صحیح</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($choices as $key => $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <x-admin.forms.input type="text" id="{{$key}}title" label="عنوان گزینه" wire:model.defer="choices.{{$key}}.title"/>
                            </td>
                            <td>
                                <x-admin.forms.input placeholder="50±" help="برای گزینه صحیح ، مثبت 100  درصد در نظر گزینه می شود" type="number" min="-100" max="100" id="{{$key}}title" label="ضریب نمره(مقدار صفر ، نمره منفی یا مثبت روی گزینه اعمال نمی کند)" wire:model.defer="choices.{{$key}}.score"/>
                            </td>
                            <td>
                                <x-admin.forms.checkbox value="1" id="{{$key}}ture" name="{{$key}}" label="انتخاب" wire:model="choices.{{$key}}.is_true" />
                            </td>
                            <td><x-admin.delete-btn onclick="deleteChoices({{$key}})"/></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </x-admin.form-section>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف سوال!',
                text: 'آیا از حذف این سوال اطمینان دارید؟',
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
                            'سوال مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteItem', id)
                }
            })
        }
        function deleteChoices(id) {
            Swal.fire({
                title: 'حذف گزینه !',
                text: 'آیا از حذف این گزینه  اطمینان دارید؟',
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
                            'گزینه  مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteChoice', id)
                }
            })
        }
    </script>
@endpush

