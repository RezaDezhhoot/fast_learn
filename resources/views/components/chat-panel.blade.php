@props(['chats' , 'message' => 'message' , 'sender' => 'user_id' , 'file_label' => 'files' , 'multiple' => true ,'file' => []])
<div>
    <div wire:ignore.self class="card card-custom">
        <!--begin::Header-->
        <div wire:ignore.self class="card-body">
            <!--begin::Scroll-->
            <div wire:ignore.self id="scroll-pull" class="scroll scroll-pull" data-height="375" data-mobile-height="300">
                <!--begin::Messages-->
                <div class="messages">
                    @forelse($chats as $item)
                        @if($item->{$sender} == auth()->id())
                            <div class="d-flex flex-column mb-5 align-items-start">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-circle symbol-35 mr-3">
                                        <img alt="Pic" src="{{ asset(auth()->user()->image) }}" />
                                    </div>
                                    <div>
                                        <a class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">شما</a>
                                        <span class="text-muted font-size-sm">
                                                     {{ $item->created_at->diffForHumans() }}
                                                </span>
                                    </div>
                                </div>
                                <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">
                                    {!! nl2br($item->{$message})  !!}
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    @if( !empty($item->{$file_label}) )
                                        @if(is_array($item->{$file_label}))
                                            @foreach($item->{$file_label} as $value)
                                                @if($value)
                                                    <p class="mr-4 py-2 cursor-pointer" wire:click="download('{{$value}}')">
                                                        <small>{{str($value)->limit(10)}}</small>
                                                        <i class="fa fa-download"></i>
                                                    </p>
                                                @endif
                                            @endforeach
                                        @else
                                            <p class="mr-4 py-2 cursor-pointer" wire:click="download('{{ $item->{$file_label} }}')">
                                                <small>{{str($item->{$file_label})->limit(10)}}</small>
                                                <i class="fa fa-download"></i>
                                            </p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="d-flex flex-column mb-5 align-items-end">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <span class="text-muted font-size-sm">{{ $item->created_at->diffForHumans() }}</span>
                                        <a  class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">
                                            {{ $item->user->name }}
                                        </a>
                                    </div>
                                    <div class="symbol symbol-circle symbol-35 ml-3">
                                        <img alt="Pic" src="{{ asset($item->user->image) }}" />
                                    </div>
                                </div>
                                <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">
                                    {!! nl2br($item->{$message})  !!}
                                </div>
                                @if(($item->{$file_label}))
                                    @if(is_array($item->{$file_label}))
                                        @foreach($item->{$file_label} as $value)
                                            @if($value)
                                            <p class="mr-4 py-2 cursor-pointer" wire:click="download('{{$value}}')">
                                                <small>{{str($value)->limit(10)}}</small>
                                                <i class="fa fa-download"></i>
                                            </p>
                                            @endif
                                        @endforeach
                                    @else
                                        <p class="mr-4 py-2 cursor-pointer" wire:click="download('{{ $item->{$file_label} }}')">
                                            <small>{{str($item->{$file_label})->limit(10)}}</small>
                                            <i class="fa fa-download"></i>
                                        </p>
                                    @endif
                                @endif
                            </div>
                        @endif
                    @empty
                        <p class="alert alert-info text-center">هیچ پاسخی ثبت نشده است</p>
                    @endforelse
                </div>
                <!--end::Messages-->
            </div>
            <!--end::Scroll-->
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <x-admin.forms.validation-errors/>
        <div wire:ignore.self class="card-footer align-items-center">
            <!--begin::Compose-->
            <textarea wire:model.defer="chatText" class="form-control border-0 p-0" rows="2" placeholder="پیامی بنویسید"></textarea>
            <div class="d-flex align-items-center justify-content-between mt-5">
                <div class="mr-3" >

                    <label for="file" class="btn btn-clean btn-icon btn-md mr-1">
                        <i class="fa fa-paperclip icon-lg"></i>
                    </label>
                    <div  x-data="{ isUploading: false, progress: 0 }"
                         x-on:livewire-upload-start="isUploading = true"
                         x-on:livewire-upload-finish="isUploading = false"
                         x-on:livewire-upload-error="isUploading = false"
                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <input {{$multiple ? 'multiple' : ''}} type="file" class="d-none" id="file" wire:model="file" aria-label="file">
                        <div class="mt-2" x-show="isUploading">

                            <progress max="100" x-bind:value="progress"></progress>
                            <small class="d-block">در حال اپلود فایل...</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-end">
                        @if(is_array($file))
                            @foreach($file as $item)
                                <p class="mr-4">
                                    <small>{{str($item->temporaryUrl())->limit(30)}}</small>
                                    <i class="flaticon-file-2"></i>
                                </p>
                            @endforeach
                        @elseif($file)
                            <p class="mr-4">
                                <small>{{str($file->temporaryUrl())->limit(30)}}</small>
                                <i class="flaticon-file-2"></i>
                            </p>
                        @endif

                    </div>
                </div>
                <div>
                    <button wire:click="sendChatText()" type="button" class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">ارسال</button>
                </div>
            </div>
            <!--begin::Compose-->
        </div>
        <!--end::Footer-->
    </div>
</div>

