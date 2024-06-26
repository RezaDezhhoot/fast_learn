<!-- template js files -->
@livewireScripts

<script src="{{ asset('site/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('site/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('site/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('site/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('site/js/isotope.js') }}"></script>
<script src="{{ asset('site/js/waypoint.min.js') }}"></script>
<script src="{{ asset('site/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('site/js/fancybox.js') }}"></script>
<script src="{{ asset('site/js/jquery.lazy.min.js') }}"></script>
{{--<script src="{{ asset('site/js/datedropper.min.js') }}}"></script>--}}
<script src="{{ asset('site/js/emojionearea.min.js') }}"></script>
<script src="{{ asset('site/js/tooltipster.bundle.min.js') }}"></script>
<script src="{{ asset('site/js/main.js') }}"></script>
<script src="{{asset('admin/js/jdate/persianDatepicker.min.js')}}"></script>
<script src="{{asset('bower_components/jquery.countdown/dist/jquery.countdown.js')}}"></script>
<script src="{{asset('site/js/plyr.js')}}"></script>
<script>
    $(document).ready(function (){
        $(".goToCommentForm").click(function (){
            $('html, body').animate({
                scrollTop: $("#commentForm").offset().top
            }, 1000);
        });
        Livewire.on('notify', data => {
            Swal.fire({
                position: 'top-end',
                icon: data.icon,
                title: data.title,
                showConfirmButton: false,
                timer: 3500,
                toast: true,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
        })
    })
</script>


@stack('scripts')
