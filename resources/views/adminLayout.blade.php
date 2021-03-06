<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>لوحة التحكم</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700') }}"
          rel="stylesheet">
    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-rtl.min.css') }}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{ asset('dist/css/custom-style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
            {{--            <li class="nav-item d-none d-sm-inline-block">--}}
            {{--                <a href="index3.html" class="nav-link">خانه</a>--}}
            {{--            </li>--}}
            {{--            <li class="nav-item d-none d-sm-inline-block">--}}
            {{--                <a href="#" class="nav-link">تماس</a>--}}
            {{--            </li>--}}
        </ul>

    {{--        <!-- SEARCH FORM -->--}}
    {{--        <form class="form-inline ml-3">--}}
    {{--            <div class="input-group input-group-sm">--}}
    {{--                <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">--}}
    {{--                <div class="input-group-append">--}}
    {{--                    <button class="btn btn-navbar" type="submit">--}}
    {{--                        <i class="fa fa-search"></i>--}}
    {{--                    </button>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </form>--}}

    <!-- Right navbar links -->
        <ul class="navbar-nav mr-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">

                @if(auth()->check())
                    <a class="nav-link" href="{{ route('logout')}}">
                        تسجيل الخروج
                    </a>
                @endif

        {{--                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">--}}
        {{--                    <a href="#" class="dropdown-item">--}}
        {{--                        <!-- Message Start -->--}}
        {{--                        <div class="media">--}}
        {{--                            <img src="{{ asset('js/app.js') }}" alt="User Avatar" class="img-size-50 ml-3 img-circle">--}}
        {{--                            <div class="media-body">--}}
        {{--                                <h3 class="dropdown-item-title">--}}
        {{--                                    حسام موسوی--}}
        {{--                                    <span class="float-left text-sm text-danger"><i class="fa fa-star"></i></span>--}}
        {{--                                </h3>--}}
        {{--                                <p class="text-sm">با من تماس بگیر لطفا...</p>--}}
        {{--                                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                        <!-- Message End -->--}}
        {{--                    </a>--}}
        {{--                    <div class="dropdown-divider"></div>--}}
        {{--                    <a href="#" class="dropdown-item">--}}
        {{--                        <!-- Message Start -->--}}
        {{--                        <div class="media">--}}
        {{--                            <img src="{{ asset('dist/img/user8-128x128.jpg') }}" alt="User Avatar"--}}
        {{--                                 class="img-size-50 img-circle ml-3">--}}
        {{--                            <div class="media-body">--}}
        {{--                                <h3 class="dropdown-item-title">--}}
        {{--                                    پیمان احمدی--}}
        {{--                                    <span class="float-left text-sm text-muted"><i class="fa fa-star"></i></span>--}}
        {{--                                </h3>--}}
        {{--                                <p class="text-sm">من پیامتو دریافت کردم</p>--}}
        {{--                                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                        <!-- Message End -->--}}
        {{--                    </a>--}}
        {{--                    <div class="dropdown-divider"></div>--}}
        {{--                    <a href="#" class="dropdown-item">--}}
        {{--                        <!-- Message Start -->--}}
        {{--                        <div class="media">--}}
        {{--                            <img src="{{ asset('dist/img/user3-128x128.jpg') }}" alt="User Avatar"--}}
        {{--                                 class="img-size-50 img-circle ml-3">--}}
        {{--                            <div class="media-body">--}}
        {{--                                <h3 class="dropdown-item-title">--}}
        {{--                                    سارا وکیلی--}}
        {{--                                    <span class="float-left text-sm text-warning"><i class="fa fa-star"></i></span>--}}
        {{--                                </h3>--}}
        {{--                                <p class="text-sm">پروژه اتون عالی بود مرسی واقعا</p>--}}
        {{--                                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i>4 ساعت قبل</p>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                        <!-- Message End -->--}}
        {{--                    </a>--}}
        {{--                    <div class="dropdown-divider"></div>--}}
        {{--                    <a href="#" class="dropdown-item dropdown-footer">مشاهده همه پیام‌ها</a>--}}
        {{--                </div>--}}
        {{--            </li>--}}
        {{--            <!-- Notifications Dropdown Menu -->--}}
        {{--            <li class="nav-item dropdown">--}}
        {{--                <a class="nav-link" data-toggle="dropdown" href="#">--}}
        {{--                    <i class="fa fa-bell-o"></i>--}}
        {{--                    <span class="badge badge-warning navbar-badge">15</span>--}}
        {{--                </a>--}}
        {{--                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">--}}
        {{--                    <span class="dropdown-item dropdown-header">15 نوتیفیکیشن</span>--}}
        {{--                    <div class="dropdown-divider"></div>--}}
        {{--                    <a href="#" class="dropdown-item">--}}
        {{--                        <i class="fa fa-envelope ml-2"></i> 4 پیام جدید--}}
        {{--                        <span class="float-left text-muted text-sm">3 دقیقه</span>--}}
        {{--                    </a>--}}
        {{--                    <div class="dropdown-divider"></div>--}}
        {{--                    <a href="#" class="dropdown-item">--}}
        {{--                        <i class="fa fa-users ml-2"></i> 8 درخواست دوستی--}}
        {{--                        <span class="float-left text-muted text-sm">12 ساعت</span>--}}
        {{--                    </a>--}}
        {{--                    <div class="dropdown-divider"></div>--}}
        {{--                    <a href="#" class="dropdown-item">--}}
        {{--                        <i class="fa fa-file ml-2"></i> 3 گزارش جدید--}}
        {{--                        <span class="float-left text-muted text-sm">2 روز</span>--}}
        {{--                    </a>--}}
        {{--                    <div class="dropdown-divider"></div>--}}
        {{--                    <a href="#" class="dropdown-item dropdown-footer">مشاهده همه نوتیفیکیشن</a>--}}
        {{--                </div>--}}
        {{--            </li>--}}
        {{--            <li class="nav-item">--}}
        {{--                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i--}}
        {{--                        class="fa fa-th-large"></i></a>--}}
        {{--            </li>--}}
        {{--        </ul>--}}
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">

            <span class="brand-text font-weight-light">لوحة التحكم</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar" style="direction: ltr">
            <div style="direction: rtl">
                <!-- Sidebar user panel (optional) -->


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <ul class="nav nav-treeview">
                                @can('manager_view')
                                    <li class="nav-item">
                                        <a href="{{ route('manager.index')}}"
                                           class="nav-link {{'manager'==request()->path()?'active':''}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>الادارة</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('positions_permissions_view')

                                    <li class="nav-item">
                                        <a href="{{ route('positions_permissions.index')}}"
                                           class="nav-link {{"positions_permissions"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>الصلاحيات والمناصب</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('media_Library_view')

                                    <li class="nav-item">
                                        <a href="{{ route('media_Library.index')}}"
                                           class="nav-link {{"media_library"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>مكتبة الصور والفيديوهات</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('banners_view')
                                    <li class="nav-item">
                                        <a href="{{ route('banners.index')}}"
                                           class="nav-link {{"banners"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>البانارات</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('main_sections_sub_sections_view')
                                    <li class="nav-item">
                                        <a href="{{ route('main_sections.index')}}"
                                           class="nav-link {{"main_sections"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>الاقسام الرئيسية</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('sub_sections.index')}}"
                                           class="nav-link {{"sub_sections"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>الاقسام الفرعية</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('products_view')
                                    <li class="nav-item">
                                        <a href="{{ route('products.index')}}"
                                           class="nav-link {{"products"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>المنتجات</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('clients_view')
                                    <li class="nav-item">
                                        <a href="{{ route('clients.index')}}"
                                           class="nav-link {{"clients"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>العملاء</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('orders_view')
                                    <li class="nav-item">
                                        <a href="{{ route('orders.index')}}"
                                           class="nav-link {{"orders"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>الطلبات</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('measure_view')
                                    <li class="nav-item">
                                        <a href="{{ route('measure.index')}}"
                                           class="nav-link {{"measure"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>دليل المقاسات</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('contact_information_view')
                                    <li class="nav-item">
                                        <a href="{{ route('contact_information.index')}}"
                                           class="nav-link {{"contact_information"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>بيانات التواصل</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('social_media_link_view')
                                    <li class="nav-item">
                                        <a href="{{ route('social_media_link.index')}}"
                                           class="nav-link {{"social_media_link"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>روابط التواصل الاجتماعي</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('shipping_charge_view')
                                    <li class="nav-item">
                                        <a href="{{ route('shipping_charge.index')}}"
                                           class="nav-link {{"shipping_charge"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>تكلفة الشحن</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('bank_accounts_view')
                                    <li class="nav-item">
                                        <a href="{{ route('bank_accounts.index')}}"
                                           class="nav-link {{"sys_bank_account"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>الحسابات البنكية</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('bank_transaction_view')
                                    <li class="nav-item">
                                        <a href="{{ route('bank_transaction.index')}}"
                                           class="nav-link {{"bank_transaction"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>التحويلات البنكية</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('comments_view')
                                    <li class="nav-item">
                                        <a href="{{ route('comments.index')}}"
                                           class="nav-link {{"comments"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>التعليقات</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('notifications_view')
                                    <li class="nav-item">
                                        <a href="{{ route('notifications.index')}}"
                                           class="nav-link {{"notifications"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>الاشعارات</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('email_box_view')
                                    <li class="nav-item">
                                        <a href="{{ route('email_box.index')}}"
                                           class="nav-link {{"email_box"==request()->path()?"active":""}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>البريد</p>
                                        </a>
                                    </li>
                                @endcan


                            </ul>
                        </li>
                    </ul>

                </nav>
                <!-- /.sidebar-menu -->
            </div>
        </div>
        <!-- /.sidebar -->
    </aside>


    <!-- /.content-header -->
@yield('content')
<!-- Main content -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('https://code.jquery.com/ui/1.12.1/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Morris.js charts -->
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js') }}"></script>
    <script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>


{{--        <script>--}}
{{--            $(document).ready(--}}
{{--                 $('nav li a').click(function() {--}}
{{--                         $(this).addClass('active');--}}
{{--                 }));--}}
{{--        </script>--}}
</body>

</html>
