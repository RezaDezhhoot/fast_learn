<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>مدیریت فایل</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="NRjAtSsM32NRlH7YXwlFbbJMfDRSXLa1eNUP4bQ8">
    <link rel="icon" sizes="16x16" href="{{asset($logo)}}" />

    <link rel="stylesheet" href="{{asset('lfm/css/bootstrap.min.css')}}" >
    <link rel="stylesheet" href="{{asset('lfm/css/file-manager.css')}}">

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="fm-main-block">
            <div id="fm"></div>
        </div>
    </div>
</div>

<!-- File manager -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // set fm height
    document.getElementById('fm-main-block').setAttribute('style', 'height:' + window.innerHeight + 'px');

    // Add callback to file manager
    fm.$store.commit('fm/setFileCallBack', function(fileUrl) {
      window.opener.fmSetLink(fileUrl);
      window.close();
    });
  });
</script>
<script src="{{asset('lfm/js/file-manager.js')}}"></script>

</body>
</html>

