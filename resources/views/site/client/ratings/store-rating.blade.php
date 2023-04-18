<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold">نظر سنجی دوره {{ $course->title }}</h3>
        </div>
        <div style="overflow-x:auto;" class="dashboard-cards mb-5">
            <section class="register-area dot-bg overflow-hidden">
                <div class="container">
                    <div class="row pt-50px">
                        <div class="col-lg-10 mx-auto">
                            <div class="card card-item">
                                <div class="card-body">
                                    <form method="post" wire:submit.prevent="store"  class="row">
                                        @foreach($poll->items as $key => $item)
                                            <div class="input-box col-12 my-2">
                                                <p>{{$loop->iteration}} - {!! $item['title'] !!}</p>
                                                <div class="form-check form-check-inline">
                                                    @foreach($item['items'] as $keyRadio => $radio)
                                                        <label class="form-check-label mx-2 ">
                                                            <input type="radio" name="{{$item['id']}}" class="form-check-input" value="{{$radio['id']}}"
                                                                   wire:model.defer="answers.{{$item['id']}}">{{$radio['title']}}
                                                        </label>
                                                    @endforeach
                                                </div>
                                                <br>
                                                @error('answers.'.$key.'.error')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                                <hr>
                                            </div>
                                        @endforeach
                                        <div class="btn-box col-lg-12 my-3">
                                            <button class="btn theme-btn" type="submit">ارسال <i class="la la-arrow-left icon ml-1"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
