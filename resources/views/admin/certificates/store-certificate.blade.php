<div>
    @section('title','گواهینامه ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف گواهینامه" mode="{{$mode}}" title="گواهینامه"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" type="text" id="name" label="عنوان *" wire:model.defer="name"/>
                <x-admin.forms.input with="6" type="text" id="title" label="اموزشگاه *" wire:model.defer="title"/>
            </div>
            <hr>
            @if($mode == self::UPDATE_MODE)
                <a class="btn btn-link" href="{{ route('user.certificate',[$demo->id,'status' => 'demo']) }}">مشاهده نمونه</a>
            <hr>
            @endif
            <x-admin.forms.lfm-standalone id="logo" label="لوگو" :file="$logo" type="image" required="true" wire:model="logo"/>
            <x-admin.forms.lfm-standalone id="bg_image" label="تصویر پس زمینه" :file="$bg_image" type="image" required="true" wire:model="bg_image"/>
            <x-admin.forms.lfm-standalone id="autograph_image" label="تصویر مهر و امضا" :file="$autograph_image" type="image" required="true" wire:model="autograph_image"/>
            <x-admin.forms.lfm-standalone id="border_image" label="تصویر قاب" :file="$border_image" type="image" required="true" wire:model="border_image"/>
            <x-admin.forms.dropdown  id="content_type" :data="$data['content_type']" label="محتوای گواهینامه*" wire:model="content_type"/>

            @if($content_type == \App\Enums\CertificateEnum::CUSTOM)
                <x-admin.form-section label="متن شخصی">
                    <x-admin.form-section label="متغیر ها">
                        <div  class="row mx-2 py-2">
                            @foreach($data['params'] as $key => $value)
                                <div class="col-2">
                                    <p class="text-base m-0"> {{$key}} </p>
                                    <small class="text-info">{{$value}}</small>
                                </div>
                            @endforeach
                        </div>
                    </x-admin.form-section>
                    <x-admin.form-section label="پارامتر">
                        <div class="d-flex align-items-end">
                            <x-admin.button class="btn btn-light-primary font-weight-bolder btn-sm" content="افزودن پارامتر" wire:click="addParam()" />
                            <x-admin.forms.input with="6" type="text" id="param_title" label="مقدار پارامتر *" wire:model="param_title"/>
                        </div>
                    </x-admin.form-section>

                    <div style="position: relative" wire:ignore.self>
                        <div id="panel"  class="bg-secondary mx-auto" wire:ignore.self style="height: 100mm;width: 290mm;background-image: url('{{asset($bg_image)}}');background-size: 100% 100%;background-repeat: no-repeat;background-position: center;">
                            @foreach($params as $key => $param)
                                @if($param['change'] == false)
                                <span  id="{{$key}}" class="item d-flex align-items-center p-4" style="cursor: grab;position:absolute; z-index: 1000;left: {{$param['left']}}px;top: {{$param['top']}}px"
                                      onmouseover="drag()">
                                    {{$param['title']}}
                                </span>
                                    <span id="key-{{$key}}" class="mx-2 text-danger fa-sm fa fa-trash deleteBtn" style="position:absolute;cursor: pointer;z-index: 500000;left: {{$param['left']}}px;top: {{$param['top']}}px"></span>

                                @endif
                            @endforeach
                        </div>
                    </div>
                </x-admin.form-section>
            @endif
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف گواهینامه!',
                text: 'آیا از حذف این گواهینامه اطمینان دارید؟',
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
                            'گواهینامه مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteItem', id)
                }
            })
        }

        function reloadParams()
        {
            jQuery('.item').appendTo("body");
            jQuery('.deleteBtn').appendTo("body");
        }

        const panel = document.getElementById('panel')

        jQuery(document).ready(function(){
            jQuery('.item').appendTo("body");
            jQuery('.deleteBtn').appendTo("body");
        });

        function drag()
        {
            const items = document.querySelectorAll('.item');
            const deleteBtn = document.querySelectorAll('.deleteBtn');
            deleteBtn.forEach((btn,k) => {
                btn.addEventListener('click',function (){
                    document.getElementById(btn.id).remove();
                    document.getElementById(btn.id.split('-')[1]).remove();
                    @this.call('deleteParam', btn.id.split('-')[1])
                })
            });

            items.forEach((ball , K) => {
                ball.onmousedown = function(event) {
                    // alert(panel.getBoundingClientRect().left);
                    var panel_top = window.pageYOffset + panel.getBoundingClientRect().top
                    var panel_left = panel.getBoundingClientRect().left
                    var panel_right = panel.getBoundingClientRect().right
                    var panel_with = panel.offsetWidth;
                    var panel_height = panel.offsetHeight;


                    let shiftX = event.clientX - ball.getBoundingClientRect().left;
                    let shiftY = event.clientY - ball.getBoundingClientRect().top;

                    ball.style.position = 'absolute';
                    ball.style.zIndex = 1000;
                    document.body.append(ball);

                    document.getElementById(`key-${ball.id}`).style.position = 'absolute';
                    document.getElementById(`key-${ball.id}`).style.zIndex = 1000;
                    document.body.append(document.getElementById(`key-${ball.id}`));

                    moveAt(event.pageX, event.pageY);

                    // moves the ball at (pageX, pageY) coordinates
                    // taking initial shifts into account
                    function moveAt(pageX, pageY) {
                        ball.style.left = pageX - shiftX + 'px';
                        ball.style.top = pageY - shiftY + 'px';

                        document.getElementById(`key-${ball.id}`).style.left = pageX - shiftX + 'px';
                        document.getElementById(`key-${ball.id}`).style.top = pageY - shiftY + 'px';

                        @this.call('setParamData', {
                            id:ball.id,panel_top , panel_left , left: pageX - shiftX , top:pageY - shiftY , panel_with , panel_height , panel_right
                        })
                    }

                    function onMouseMove(event) {
                        moveAt(event.pageX, event.pageY);
                    }

                    // move the ball on mousemove
                    document.addEventListener('mousemove', onMouseMove);

                    // drop the ball, remove unneeded handlers
                    ball.onmouseup = function() {
                        document.removeEventListener('mousemove', onMouseMove);
                        ball.onmouseup = null;

                    };

                };

                ball.ondragstart = function() {
                    return false;
                };
            })
        }


    </script>
@endpush
