<div wire:init="loadComments">
    @auth
        <div class="course-overview-card pt-4">
            <h3 class="fs-24 font-weight-semi-bold pb-4">{{ $actionLabel }}</h3>
            <form method="post" id="commentForm" class="row" wire:submit.prevent="new_comment">
                @auth
                    <div class="input-box col-lg-12">
                        <label class="label-text">پیام</label>
                        <div class="form-group">
                                        <textarea wire:model.defer="comment" class="form-control form--control pl-3"
                                                  name="message" placeholder="پیام بنویس" rows="5"></textarea>
                        </div>
                        @error('comment')
                        <span class="invalid-feedback d-block">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="btn-box col-lg-12">
                        <!-- end custom-control -->
                        <button class="btn theme-btn" type="submit">ارسال دیدگاه</button>
                    </div>
                @else
                    <p class="text-info">
                        برای ثبت دیدگاه ابتدا ثبت نام کنید
                    </p>
                @endif
                <!-- end btn-box -->
            </form>
        </div>
    @else
        <p class="text-info">
            برای ثبت دیدگاه ابتدا ثبت نام کنید
        </p>
    @endif
    <div class="course-overview-card pt-4">
        <h3 class="fs-24 font-weight-semi-bold pb-4">پرسش و پاسخ</h3>
        <div class="review-wrap">
            @if(sizeof($comments) > 0)
                @for($i=0;$i<$commentCount ;$i++) @isset($comments[$i]) <div
                    class="media media-card shadow-sm p-3 mb-4 bg-white rounded pb-4 mb-1">
                    <div class="media-img mr-4 rounded-full">
                        <img class="rounded-full lazy" src="{{ asset($comments[$i]->user->image) }}"
                             data-src="{{ asset($comments[$i]->user->image) }}"
                             alt="{{ $comments[$i]->user->name }}" />
                    </div>
                    <div class="media-body">
                        <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                            <h5>{{ $comments[$i]->user->name }} {{ $comments[$i]->user->id ==
                                                $course_data->teacher->id ? " (مدرس) " : '' }}</h5>
                        </div>
                        <span class="d-block lh-18 py-2">{{ $comments[$i]->created_at->diffForHumans()
                                            }}</span>
                        <p class="pb-2">
                            {!! $comments[$i]->content !!}
                        </p>
                        <div class="helpful-action">
                            <button wire:click="$set('actionComment',{{$comments[$i]->id}})"
                                    class="btn btn-outline-success goToCommentForm">پاسخ</button>
                        </div>
                    </div>
                </div>
                @foreach($comments[$i]->childrenRecursive as $value)
                    <div
                        class="media media-card pb-4 shadow-sm p-3 mb-5 bg-white rounded p-3 mb-4 review-reply">
                        <div class="media-img mr-4 rounded-full">
                            <img class="rounded-full lazy" src="{{ asset($value->user->image) }}"
                                 data-src="{{ asset($value->user->image) }}" alt="{{ $value->user->name }}" />
                        </div>
                        <div class="media-body">
                            <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                                <h5>{{ $value->user->name }} {{ $value->user->id == $course_data->teacher->id ? "
                                            (مدرس) " : '' }}</h5>
                            </div>
                            <span class="d-block lh-18 py-2">{{ $value->created_at->diffForHumans() }}</span>
                            <p class="pb-2">
                                {!! $value->content !!}
                            </p>
                        </div>
                    </div>
                @endforeach
                @if ($i != count($comments) - 1)
                    <hr>
                @endif
                @endif

                @endfor
            @else
                <p class="alert alert-info">
                    هیچ پرسش و پاسخی ثبت نشده است
                </p>
            @endif

            <!-- end media -->
        </div>
        <!-- end review-wrap -->
        <div class="see-more-review-btn text-center">
            @if($commentCount < count($comments))
                <button type="button" wire:click="moreComment()"
                        class="btn theme-btn theme-btn-transparent">بارگیری نظرات بیشتر</button>
            @endif
        </div>
    </div>
</div>
