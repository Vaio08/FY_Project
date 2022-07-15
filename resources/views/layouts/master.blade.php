<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
    @include('layouts._head')
</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
<div class="page-wrapper">
    <!-- start header -->
    <div class="page-header navbar navbar-fixed-top">
        @include('layouts._header')
    </div>
    <!-- end header -->
    <!-- start page container -->
    <div class="page-container">
        <!-- start sidebar menu -->
        <div class="sidebar-container">
            @include('layouts._leftNav')
        </div>
        <!-- end sidebar menu -->
        <!-- start page content -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <div class="page-title-breadcrumb">
                        <div class=" pull-left">
                            <div class="page-title">@yield('title')</div>
                        </div>
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li>
                                <i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{route('dashboard')}}">Home</a>&nbsp;<i
                                    class="fa fa-angle-right"></i>
                            </li>
                            @yield('breadcrumb')
                        </ol>
                    </div>
                </div>
                @include('sweetalert::alert')
                @yield('content')
            </div>
        </div>
        <!-- end page content -->
    </div>
    <!-- end page container -->
    <!-- start footer -->
        @include('layouts._footer')
    <!-- end footer -->
</div>
<!-- start js include path -->
    @include('layouts._scripts')
<!-- end js include path -->
</body>
</html>

