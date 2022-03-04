<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<base href="http://localhost:8000">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{asset('assets__/media/image/favicon.png')}}"/>

<!-- Plugin styles -->
<link rel="stylesheet" href="{{mix('assets/panel/css/ht-panel.css')}}" type="text/css">
<!-- App styles -->

