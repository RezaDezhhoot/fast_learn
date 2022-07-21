<div xmlns:wire="http://www.w3.org/1999/xhtml">
    @section('title','کاربر ')
    <x-admin.form-control mode="{{$mode}}" title="کاربران"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" type="text" id="first_name" label="نام*" wire:model.defer="name"/>
                <x-admin.forms.input with="6" type="text" id="phone" label="شماره همراه*" wire:model.defer="phone"/>
                <x-admin.forms.input with="6" type="email" id="email" label="ایمیل*" wire:model.defer="email"/>
                <x-admin.forms.dropdown with="6" id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
                <x-admin.forms.input with="6" type="text" id="id_code" label="شماره ملی" wire:model.defer="code_id"/>
                <x-admin.forms.input with="6" type="text" id="father_name" label="نام پدر" wire:model.defer="father_name"/>
                <x-admin.forms.input with="6" type="text" id="birthday" label="تاریخ تولد" wire:model.defer="birthday"/>
                <x-admin.forms.dropdown with="6" id="province" :data="$data['province']" label="استان" wire:model="province"/>
                <x-admin.forms.dropdown with="6" id="city" :data="$data['city']" label="شهر" wire:model.defer="city"/>
                @if($mode == self::CREATE_MODE)
                    <x-admin.forms.input type="password" help="حداقل {{ $password_lgh}} حرف شامل اعداد و حروف" id="password" label="گذرواژه*" wire:model.defer="password"/>
                @endif
            </div>
            <hr>
            <x-admin.forms.lfm-standalone id="image" label="تصویر " :file="$image" type="image" required="true" wire:model="image"/>
            <hr>
            <x-admin.form-section label="نقش">
                <div class="row">
                    @foreach($data['role'] as  $value)
                        <div class="col-2">
                            <x-admin.forms.checkbox label="{{$value['name']}}" id="permissions-{{$value['id']}}" value="{{$value['name']}}" wire:model.defer="roles" wire:model.defer="userRole.{{$value['id']}}" />
                        </div>
                    @endforeach
                </div>
            </x-admin.form-section>
            @if($mode == self::UPDATE_MODE)
                <hr>
                <x-admin.form-section label="مشاهده لاگ های این کاربر" >
                    <p>
                        <a class="btn btn-outline-success" href="{{route('admin.log',['user'=>$user->id])}}">مشاهده</a>
                    </p>
                </x-admin.form-section>

                <hr>
                <x-admin.form-section label="کیف پول" >
                    <div class="form-group" style="padding: 5px">
                        <div class="form-control" >
                            موجودی کل :
                            {{  number_format($user->balance) }}تومان
                        </div>
                    </div>
                    <x-admin.forms.dropdown id="action" :data="$data['action']" label="عملیات" wire:model.defer="actionWallet"/>
                    <x-admin.forms.input type="number" id="editWallet" label="مبلغ(تومان)" wire:model.defer="editWallet"/>
                    <x-admin.forms.full-text-editor id="walletMessage" label="متن توضیحات" wire:model.defer="walletMessage"/>
                    <x-admin.button content="تایید" class="primary" wire:click="wallet()" />
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>تاریخ</th>
                            <th>مبلغ</th>
                            <th>نوع تراکنش</th>
                            <th>جزئیات</th>
                        </tr>
                        </thead>
                        <tbody wire:sortable="updateFormPosition()">
                        @forelse($userWallet as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="comment__date">
                                        <span class="comment__date-day">{{Morilog\Jalali\Jalalian::forge($item->created_at)->format('%d')}}</span>
                                        <span class="comment__date-month">{{Morilog\Jalali\Jalalian::forge($item->created_at)->format('%B')}}</span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap">
                                <span class="flex items-center gap-1"><span class="font-semibold">{{number_format($item->amount)}}</span><span
                                        class="text-sm">تومان</span></span>
                                </td>
                                <td>{{$item->type == \Bavix\Wallet\Models\Transaction::TYPE_WITHDRAW ? 'برداشت' : 'واریز'}}</td>
                                <td>{!! $item->meta['description'] !!}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">
                                    دیتایی جهت نمایش وجود ندارد
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </x-admin.form-section>
                <x-admin.form-section label="ارسال پیام">
                    <x-admin.forms.full-text-editor id="sendMessage" label="متن پیام" wire:model.defer="sendMessage"/>
                    <x-admin.forms.dropdown id="actions" :data="$data['subjectMessage']" label="موضوع" wire:model.defer="subjectMessage"/>
                    <x-admin.button content="ارسال" class="primary" wire:click="sendMessage()" />
                </x-admin.form-section>
                <x-admin.form-section label="تاریخپه" >
                    <table class="table-bordered table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>موضوع</th>
                            <th>متن</th>
                            <th>نوع</th>
                            <th>تاریخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tbody wire:sortable="updateFormPosition()">
                        @forelse($result as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->subject ? $item->subject_label : 'بدون موضوع' }}</td>
                                <td style="max-width: 400px">{!! $item->content !!}</td>
                                <td>{{ $item->type_label }}</td>
                                <td>
                                    <div class="comment__date">
                                        <span class="comment__date-day">{{Morilog\Jalali\Jalalian::forge($item->created_at)->format('%d')}}</span>
                                        <span class="comment__date-month">{{Morilog\Jalali\Jalalian::forge($item->created_at)->format('%B')}}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="6">
                                    دیتایی جهت نمایش وجود ندارد
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </x-admin.form-section>
            @endif
        </div>
    </div>
</div>

