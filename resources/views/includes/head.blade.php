<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
<link rel="icon" href="{{ URL::asset('public/assets/img/icon.ico') }}" type="image/x-icon"/>

<!-- Fonts and icons -->
<script type="text/javascript" src="{{ URL::asset('public/assets/js/plugin/webfont/webfont.min.js') }}"></script>
<script>
    WebFont.load({
        google: {"families":["Lato:300,400,700,900"]},
        custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["{{ URL::asset('public/assets/css/fonts.min.css') }}"]},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>

<!-- CSS Files -->
<link rel="stylesheet" href="{{ URL::asset('public/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('public/assets/css/atlantis.min.css') }}">

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="{{ URL::asset('public/assets/css/demo.css') }}">
<style>
    .required {
        color: red;
    }
</style>