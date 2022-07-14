<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" sizes="16x16" href="{{asset($logo)}}" />

    <title>{{ config('app.name', 'File Manager') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://file-manager.webmai.ru/vendor/file-manager/css/file-manager.css">
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

    // Helper function to get parameters from the query string.
    function getUrlParam(paramName) {
      const reParam = new RegExp('(?:[\?&]|&)' + paramName + '=([^&]+)', 'i');
      const match = window.location.search.match(reParam);

      return (match && match.length > 1) ? match[1] : null;
    }

    // Add callback to file manager
    fm.$store.commit('fm/setFileCallBack', function(fileUrl) {
      const funcNum = getUrlParam('CKEditorFuncNum');

      window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
      window.close();
    });
  });
</script>
<script src="https://file-manager.webmai.ru/vendor/file-manager/js/file-manager.js"></script>

</body>
</html>

