<div>
    @section('title',' فرم های ارسالی ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف فرم" mode="{{$mode}}" title="فرم های ارسالی" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <div class="card-body">
            @if(!is_null($formModel->user))
            <x-admin.form-section label="کاربر">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>کد کاربر</th>
                                <td>نام</td>
                                <td>شماره همراه</td>
                                <td>وضعیت</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $formModel->user->id }}</td>
                                <td>{{ $formModel->user->name }}</td>
                                <td>{{ $formModel->user->phone }}</td>
                                <td>{{ $formModel->user->status_label }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </x-admin.form-section>
            @endif
                <x-admin.form-section label="فرم">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <td>عنوان</td>
                                    <td>موضوع</td>
                                    <td>تاریخ</td>
                                    <td>فضای ذخیره سازی</td>
                                    @if($formModel->rating)
                                        <th>دوره اموزشی</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $formModel->form_details['form_title'] }}</td>
                                    <td>{{ $formModel->subject_label }}</td>
                                    <td>{{ $formModel->date }}</td>
                                    <td><x-admin.forms.dropdown disabled id="storage" :data="$data['storage']" label="فضای ذخیره سازی فایل های ارسالی" wire:model.defer="storage"/></td>
                                    @if($formModel->rating)
                                    <td>
                                        <ul>
                                            <li>شناسه : {{ $formModel->rating->course->id ?? '' }}</li>
                                            <li>عنوان : {{ $formModel->rating->course->title ?? '' }}</li>
                                        </ul>
                                    </td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </x-admin.form-section>
                <x-admin.form-section label="جواب ها">
                    <div class="row">
                        <div class="col-12">
                            @if(sizeof($formModel->form_data) > 0)
                            <table class="table table-striped table-bordered">
                                <tbody>
                                @foreach($formModel->form_data as $key => $form)
                                    <tr>
                                        <td>{!! $form['label'] ?? '' !!}</td>
                                        <td>
                                            @if($form['type'] == 'file')
                                                @if(!empty($form['value']))
                                                    <button wire:click="download({{$key}})" class="btn btn-outline-primary btn-sm ">دانلود فایل</button>
                                                @endif
                                            @else
                                                {{ $form['value'] ?? ''}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>

                </x-admin.form-section>
        </div>
    </div>
</div>
