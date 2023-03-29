<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#1BC5BD", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#6993FF", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#1BC5BD", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#E1E9FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>

<script src="{{asset('teacher/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('teacher/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
<script src="{{asset('teacher/js/scripts.bundle.js')}}"></script>
{{--<script src="https://keenthemes.com/metronic/assets/js/engage_code.js"></script>--}}
<script src="{{asset('teacher/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<script src="{{asset('teacher/js/pages/widgets.js')}}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{asset('teacher/plugins/custom/datepicker/persian-date.min.js')}}"></script>
<script src="{{asset('teacher/plugins/custom/datepicker/persian-datepicker.min.js')}}"></script>
<script src="{{asset('admin/js/select2.min.js')}}"></script>
<script src="{{asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script src="{{asset('teacher/js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>

@livewireScripts

<script src="{{asset('teacher/js/pages/widgets.js') }}"></script>
<script>
    Livewire.on('showModal', function (data) {
        const id = '#' + data + 'Modal';
        $(id).modal('show');
    })

    Livewire.on('hideModal', function (data) {
        const id = '#' + data + 'Modal';
        $(id).modal('hide');

    })

    Livewire.on('notify', data => {
        Swal.fire({
            position: 'bottom-start',
            icon: data.icon,
            title: data.title,
            showConfirmButton: false,
            timer: 4000,
            toast: true,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    })

    $.fn.modal.Constructor.prototype.enforceFocus = function() {
        modal_this = this
        $(document).on('focusin.modal', function (e) {
            if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length
                && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select')
                && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
                modal_this.$element.focus()
            }
        })
    };
</script>

@stack('scripts')
