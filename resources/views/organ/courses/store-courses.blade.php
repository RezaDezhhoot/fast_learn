<div>
    @section('title','دوره  ')
    <x-organ.form-control deleteAble="true" store="{{false}}" deleteAble="{{false}}"  mode="{{$mode}}" title="{{$header}}" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <div class="card-body">
           @if($mode == self::UPDATE_MODE)
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <td>عنوان دوره اموزشی</td>
                                <td>سطح دوره اموزشی</td>
                                <td>مدرس</td>
                                <td>اموزشکاه</td>
                                <td>تایم لاین دوره</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$course->title}}</td>
                                <td>{{$course->level_label}}</td>
                                <td>{{$course->user->name ?? ''}}</td>
                                <td>{{$course->organ->title ?? ''}}</td>
                                <td>{{$course->time_line_label}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        <fieldset class="border p-4">
                            <legend>شرح درخواست</legend>
                            {!! $course->descriptions !!}
                        </fieldset>
                    </div>
                </div>
                <br>
                <x-organ.form-section label="فایل ها">
                    @if(!empty($course->files))
                        @foreach($course->files as $item)
                            <strong class="d-block">
                                <button class="btn btn-sm btn-outline-success" wire:click="download('{{$item}}')">بارگیری فایل</button>
                            </strong>
                        @endforeach
                    @endif
                </x-organ.form-section>
                <x-organ.form-section label="پاسخ ها">
                    <x-chat-panel :chats="$course->chats" :file="$file" />
                </x-organ.form-section>
            @endif
        </div>
    </div>
</div>
