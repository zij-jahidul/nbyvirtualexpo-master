<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <style>
      #notify{
        /* max-width:600px;
        max-height:400px;
        width:600px;
        height:400px;
        position:absolute;
        left:0;
        right:0;
        top:15%;
        translate:59%;
        bottom:0;
        background:#000;
        opacity:0.4;
        z-index:999999999999999; */
      }

      .notification_list{
        top: 50%;
        bottom: 50%;
        width: 90%;
        traslate: 50%;
        translate: 6%;
        left: 0%;
        right: 0%;
        opacity: 0.9;
        height: 123px;
        font-size: 3em;
        z-index:999999999999999;
        position:absolute;
        cursor:pointer;
      }




    </style>

</head>
<body>


<div id="app_frontend">

</div>

<script  src="https://www.gstatic.com/firebasejs/7.21.1/firebase-app.js"></script>
<script  src="https://www.gstatic.com/firebasejs/7.21.1/firebase-analytics.js"></script>
<script  src="https://www.gstatic.com/firebasejs/7.21.1/firebase-messaging.js"></script>

<script type="application/json" src="{{ asset('manifest.json') }}"></script>

<script  src="{{ asset('public/firebase/firebase-config.js') }}"></script>

<script src="{{ asset('public/js/app_frontend.js') }}"></script>

<script>
var now = Date.now();
navigator.mediaDevices.getUserMedia({audio: true, video: false})
.then(function(stream) {
  console.log('Got stream, time diff :', Date.now() - now);
})
.catch(function(err) {
  console.log('GUM failed with error, time diff: ', Date.now() - now);
});


</script>


</body>
</html>
