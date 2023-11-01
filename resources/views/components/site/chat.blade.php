@props(['chats' , 'message' => 'message' , 'sender' => 'user_id' , 'date' => 'date' , 'file_label' => 'files' , 'multiple' => true ,'file' => []])
<div class="container-fluid">
    <div class="dashboard-message-wrapper d-flex my-4">

        <!-- message-sidebar -->
        <div class="message-content flex-grow-1">

            <!-- message-header -->
            <div class="conversation-wrap">
                <div class="conversation-box custom-scrollbar-styled">
                    @forelse($chats as $item)
                        @if($item->{$sender} == auth()->id())
                            <div class="conversation-item message-reply mb-3">
                                <div class="media media-card align-items-center">
                                    <div class="avatar-sm flex-shrink-0 mr-4">
                                        <img class="rounded-full img-fluid" src="{{ asset(auth()->user()->image) }}" alt="تصویر آواتار" />
                                    </div>
                                    <div class="media-body d-flex align-items-center">

                                        <div class="message-body">
                                            <h5 class="fs-13">
                                                {!! nl2br($item->{$message})  !!}
                                            </h5>
                                            <span class="fs-12 d-block lh-18 pt-1">{{ $item->{$date} }} <i class="la la-check ml-1"></i></span>
                                            @if(($item->{$file_label}))
                                                @if(is_array($item->{$file_label}))
                                                    @foreach($item->{$file_label} as $value)
                                                        @if($value)
                                                            <p class="cursor-pointer" wire:click="download('{{$value}}')">
                                                                <i class="la la-download"></i>
                                                                <small>{{str($value)->limit(10)}}</small>
                                                            </p>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <p class="mr-4 py-2 cursor-pointer" wire:click="download('{{ $item->{$file_label} }}')">
                                                        <small>{{str($item->{$file_label})->limit(10)}}</small>
                                                        <i class="la la-download"></i>
                                                    </p>
                                                @endif
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                    <!-- conversation-item -->
                        @else
                            <div class="conversation-item message-sent mb-3">
                        <div class="media media-card align-items-center">
                            <div class="avatar-sm flex-shrink-0 mr-4">
                                <img class="rounded-full img-fluid" src="{{ asset($item->user->image) }}" alt="تصویر آواتار" />
                            </div>
                            <div class="media-body d-flex align-items-center">
                                <div class="message-body">
                                    <h5 class="fs-13">
                                        {!! nl2br($item->{$message})  !!}
                                    </h5>
                                    <span class="fs-12 d-block lh-18 pt-1">{{ $item->{$date} }} <i class="la la-check ml-1"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endif
                    @empty
                        <p class="alert alert-info text-center">هیچ پاسخی ثبت نشده است</p>
                    @endforelse
                </div>
                <!-- conversation-box -->
            </div>
            <!-- conversation-wrap -->
            <div class="message-reply-body d-flex align-items-center pt-2 px-4 border-top border-top-gray">
                <form  class="flex-grow-1">
                    <textarea wire:model.defer="chatText" class="form-control" placeholder="پیام" rows="3"></textarea>
                </form>
                <div class="file-upload-wrap file--upload-wrap file-upload-wrap-3">

                    <div  x-data="{ isUploading: false, progress: 0 }"
                          x-on:livewire-upload-start="isUploading = true"
                          x-on:livewire-upload-finish="isUploading = false"
                          x-on:livewire-upload-error="isUploading = false"
                          x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <input type="file" {{$multiple ? 'multiple' : ''}}  class="multi file-upload-input lh-18" wire:model="file" />
                        <span class="file-upload-text"><i class="la la-paperclip"></i></span>
                        <div class="mt-2" x-show="isUploading">
                            <progress class="w-100" max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                </div>
                <!-- file-upload-wrap -->
                <button type="button" wire:click="sendChatText()" class="message-send icon-element icon-element-xs bg-1 text-white ml-2 border-0 send-icon">
                    <i class="la la-paper-plane"></i>
                </button>
            </div>
            <div class="message-reply-body d-flex align-items-center pt-2 px-4 border-top border-top-gray">

                @if(is_array($file))
                    @foreach($file as $item)
                        <p class="text-success">
                            <i class="la la-file"></i>
                        </p>
                    @endforeach
                @elseif($file)
                    <p class="text-success">
                        <i class="la la-file"></i>
                    </p>
                @endif
            </div>

        </div>
        <!-- message-content -->
    </div>
    <!-- end row -->
</div>
