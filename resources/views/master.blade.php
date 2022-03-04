<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    @include('portion.head')
    @yield('css')
</head>
<body>
<!-- begin::header -->
@include('portion.header')
<!-- end::header -->

<!-- begin::main -->
<div id="main">
    <!-- begin::navigation -->
@include('portion.navigation')
    <!-- end::navigation -->

    <!-- begin::main-content -->
    <div class="main-content">
    @yield('content')

    <!-- begin::footer -->
    @include('portion.footer')
    <!-- end::footer -->
    </div>
    <!-- end::main-content -->
</div>
<!-- end::main -->
@include('portion.script')
@yield('js')
</body>
</html>
