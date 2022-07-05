<div>
    <div class="certificate" style="background-image: url('{{ asset($certificate->certificate->bg_image) }}')">
        <div class="certificate-border p-4" style="background-image: url('{{ asset($certificate->certificate->border_image) }}')">
            <header>
                <div class="logo">
                    <img src="{{asset($certificate->certificate->logo)}}" alt="">
                </div>
                <div class="title">
                    <h1>گواهینامه </h1>
                    <h5 class="pt-1">
                        <span>
                            (</span><span  class="text-red">{{$certificate->transcript->course->category->title ?? 'دسته بندی'}}</span><span>)
                        </span>
                    </h5>
                </div>
                <div class="codes">
                    <div class="codes_row">
                        <p>
                            <b>
                                تاریخ صدور : {{ $certificate->transcript->updated_date ?? '-' }}
                            </b>
                        </p>
                        <p>
                            <b>
                                شماره گواهینامه : {{ $certificate->transcript->id ?? '-' }}
                            </b>
                        </p>
                        <p>
                            <b>
                                کد دوره : {{ $certificate->transcript->course->id ?? '000' }}
                            </b>
                        </p>
                    </div>
                    <div class="codes_row">
                        {!! QrCode::size(100)->generate(url()->current()) !!}
                    </div>
                </div>
            </header>
            <main>
                <div class="content">
                    <div class="row mt-4">
                        <div class="row">
                            <div class="col-1">

                            </div>
                            <div class="col-9">
                                <div class="col-10">
                                   <table>
                                       <tr>
                                           <td>
                                               <b>گواهی می شود اقا/خانم</b>
                                               <span>{{ $certificate->user->name ?? '-' }}</span>
                                           </td>
                                       </tr>
                                   </table>
                               </div>
                                <div class="col-10">
                                    <table>
                                        <tr>
                                            <td>
                                                <b>فرزند</b>
                                                <span>{{ $certificate->user->details->father_name ?? 'نام پدر' }}</span>
                                            </td>
                                            <td>
                                                <b>به شماره ملی</b>
                                                <span>{{ $certificate->user->details->code_id ?? '0000' }}</span>
                                            </td>
                                            <td>
                                                <b>صادره از</b>
                                                <span>{{ $certificate->user->details->city_label ?? 'نام شهر' }}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-10">

                                </div>
                            </div>
                            <div class="col-2 p-1 d-flex justify-content-end">
                                @if(!empty($certificate->user->image))
                                    <img class="certificate-image" src="{{ asset($certificate->user->image) }}" alt="">
                                @endif
                            </div>
                            <div class="col-1">

                            </div>
                            <div class="col-11">
                                <div class="col-12">
                                    <table>
                                        <tr>
                                            <td>
                                                <b>دوره اموزشی</b>
                                                <span>{{ $certificate->transcript->course->title ?? 'نام دوره اموزشی' }}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12">
                                    <table>
                                        <tr>
                                            <td>
                                                <b>را که از تاریخ</b>
                                                <span dir="ltr">{{  $certificate->transcript->create_date ?? 'تاریخ شروع' }}</span>
                                            </td>
                                            <td>
                                                <b>تا </b>
                                                <span dir="ltr">{{ $certificate->transcript->updated_date ?? 'تاریخ پایان' }}</span>
                                            </td>
                                            <td>
                                                <b>به مدت </b>
                                                <span>
                                                    {{ $hour }}ساعت
                                                </span>
                                                <b>در</b>
                                                <span>{{$certificate->certificate->title ?? 'نام اموزشگاه'}}</span>
                                            </td>
                                            <td>
                                                <b>    برگذار گردید با موفقیت </b>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-1">

                            </div>
                            <div class="col-5">
                                <table>
                                    <tr>
                                        <td>
                                            <b>   و کسب نمره</b>
                                            <span>{{ $certificate->transcript->score ?? 'نمره کسب شده' }}</span>
                                        </td>
                                        <td>
                                            <b> به  پایان رسانده است.</b>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer>
                <div class="autograph">
                    <img src="{{ asset($certificate->certificate->autograph_image) }}" >
                </div>
            </footer>
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary  no-print controls" onclick="window.print()">
            <i class="fa fa-print"></i>
            چاپ
        </button>
        <a href="{{ url()->previous() }}" class="btn btn-danger no-print controls" >
            <i class="fa fa-backward"></i>
            بازگشت
        </a>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        var replaceDigits = function() {
            var map = ["&\#1776;","&\#1777;","&\#1778;","&\#1779;","&\#1780;","&\#1781;","&\#1782;","&\#1783;","&\#1784;","&\#1785;"]
            document.body.innerHTML = document.body.innerHTML.replace(/\d(?=[^<>]*(<|$))/g, function($0) { return map[$0]});
        }
        window.onload = replaceDigits;
    </script>

@endpush
