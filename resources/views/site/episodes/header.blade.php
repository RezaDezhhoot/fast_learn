<div>
    <section class="header-menu-area">
        <div class="header-menu-content bg-dark">
            <div class="container-fluid">
                <div class="main-menu-content d-flex align-items-center">
                    <div class="course-dashboard-header-title pl-4">
                        <a class="text-white fs-15">{{ $episode_data->title }}</a>
                    </div>
                    <div class="menu-wrapper ml-auto">
                        <div class="nav-left-button d-flex align-items-center">
                            @if(! $has_reported)
                                <a data-toggle="modal" data-target="#reportModal" class="btn theme-btn theme-btn-sm theme-btn-transparent lh-26 text-white mr-2" >
                                    <i class="la la-warning mr-1"></i>گزارش تخلف
                                </a>
                            @endif
                            <a wire:click="like" class="btn theme-btn theme-btn-sm theme-btn-transparent lh-26 text-white mr-2" >
                                <i class="la {{ $has_liked ? 'la-star' : 'la-star-o' }} mr-1"></i> امتیاز دهید
                            </a>
                            <a href="{{route('course',$course_data->slug)}}" class="btn theme-btn theme-btn-sm theme-btn-transparent lh-26 d-flex align-items-center text-white mr-2">  بازگشت به دوره اموزشی<i class="la la-arrow-left mr-1 la-lg"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade modal-container" wire:ignore.self id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-gray">
                    <div class="pr-2">
                        <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="reportModalTitle">گزارش تخلف</h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="نزدیک">
                        <span aria-hidden="true" class="la la-times"></span>
                    </button>
                </div>
                <!-- end modal-header -->
                <div class="modal-body">
                    <form wire:submit.prevent="report()">
                        <div class="input-box">
                            <label class="label-text">نوع گزارش را انتخاب کنید</label>
                            <div class="form-group">
                                <div class="select-container w-auto">
                                    <select class="select-container-select form-control form--control pl-3" wire:model.defer="subject">
                                        <option value="">-- یکی را انتخاب کن --</option>
                                        @foreach($subjects as $key => $subject)
                                            <option value="{{$key}}">{{$subject}}</option>
                                        @endforeach
                                    </select>
                                    @error('subject')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="btn-box text-left pt-2">
                            <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">لغو کنید</button>
                            <button type="submit" class="btn theme-btn theme-btn-sm lh-30">ارسال <i class="la la-arrow-left icon ml-1"></i></button>
                        </div>
                    </form>
                </div>
                <!-- end modal-body -->
            </div>
            <!-- end modal-content -->
        </div>
        <!-- end modal-dialog -->
    </div>
</div>
