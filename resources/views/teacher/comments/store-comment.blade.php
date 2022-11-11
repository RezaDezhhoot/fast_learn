<div>
    @section('title',' کامنت ')
    <x-admin.form-control :deleteAble="false" :store="false" mode="{{$mode}}" title="کامنت"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <x-admin.form-section label="کاربر">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <td>نام</td>
                                <td>شماره همراه</td>
                                <td>وضعیت</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $comment->user->name }}</td>
                                <td>{{ $comment->user->phone }}</td>
                                <td>{{ $comment->user->status_label }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </x-admin.form-section>
            <x-admin.form-section label="کامنت">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <td>دوره اموزشی</td>
                                <td>وضعیت</td>
                                <th> دیدگاه</th>
                                <td>دیدگاه والد</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $case }}</td>
                                <td>{{ $comment->status_label }}</td>
                                <td>{{ is_null($comment->parent_id) ? 'دیدگاه اصلی' : 'ارسال پاسخ' }}</td>
                                <td>
                                    @if($comment->parent)
                                        <a href="{{route('teacher.store.comments',['edit',$comment->parent->id])}}">مشاهده</a>
                                    @else
                                        ندارد
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 mt-4">
                        <fieldset class="border p-4">
                            <legend class="font-size-h6">متن اصلی </legend>
                            {!! $comment->content !!}
                        </fieldset>
                    </div>
                </div>
            </x-admin.form-section>
            <hr>
            @if(is_null($comment->parent_id))
                <x-admin.form-section label="تاریخپه">
                    <div class="row">
                        @foreach($child as $key =>  $item)
                            <div class="col-lg-12 border" style="border: 1px gray solid;padding: 5px;border-radius: 5px;margin: 10px">
                                <h5>
                                    {{ $item->user->name }}:
                                </h5>
                                <small>
                                    {{ $item->date }}
                                </small>
                                <hr>
                                <p>
                                    {!! $item->content !!}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </x-admin.form-section>
                <x-admin.form-section label="ارسال پاسخ">
                    <x-admin.forms.full-text-editor id="answer" label="متن" wire:model.defer="answer"/>
                    <x-admin.button class="primary" content="ثبت" wire:click="newAnswer()" />
                </x-admin.form-section>
            @endif
        </div>
    </div>
</div>
