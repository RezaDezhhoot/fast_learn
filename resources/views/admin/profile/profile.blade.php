<div>
    @section('title','پروفایل')
    <x-admin.form-control  title="{{ $header }}"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
           <div class="row">
               <x-admin.forms.input with="6" type="text" id="name" label="نام*" wire:model.defer="name"/>
               <x-admin.forms.input with="6" type="text" id="phone" label="شماره همراه*" wire:model.defer="phone"/>
               <x-admin.forms.input with="6" type="text" id="email" label="ایمیل*" wire:model.defer="email"/>
               <x-admin.forms.input with="6" type="password" id="pass_word" help="حداقل {{ $password_length }} حرف شامل اعداد و حروف" label="رمزعبور" wire:model.defer="password"/>
           </div>
            <div class="form-group">
                <label class="form-label" for="file">تصویر پروفایل</label>
                <div x-data="{ isUploading: false, progress: 0 }"
                     x-on:livewire-upload-start="isUploading = true"
                     x-on:livewire-upload-finish="isUploading = false"
                     x-on:livewire-upload-error="isUploading = false"
                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <input type="file" id="file" wire:model="file" aria-label="file" />

                    <div class="mt-2" x-show="isUploading">
                        در حال اپلود تصویر...
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                    <br>
                    <small class="text-info">حداقل حجم مجاز : {{$max_file_size}} کیلوبایت</small>
                </div>
                <br>
                @if(!is_null($file))
                    <img style="max-width: 150px;border-radius: 5px" src="{{ $file->temporaryUrl() }}">
                @elseif($user->image)
                    <img style="max-width: 150px;border-radius: 5px" src="{{asset($user->image)}}" alt="">
                @endif
            </div>
            <x-admin.form-section label="نقش های من">
                <ul>
                    @foreach($user->roles as $item)
                        <il>
                            <h5>{{$item->name}}</h5>
                            <hr>
                        </il>
                    @endforeach
                </ul>
            </x-admin.form-section>
        </div>
    </div>
</div>
