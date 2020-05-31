<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from coderthemes.com/ubold/layouts/light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Feb 2020 04:57:48 GMT -->
<head>
    <meta charset="utf-8" />
    <title>UBold - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="{{asset('assets/libs/ladda/ladda-themeless.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
 <!--<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">-->
    <link href="{{asset('assets/libs/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables/buttons.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables/select.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/custombox/custombox.min.css')}}" rel="stylesheet">

    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">--->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="{{asset('css/alertjs.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/clockpicker/bootstrap-clockpicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />




    <!-- Main css -->




</head>

<body>

<!-- Begin page -->
<div id="wrapper">

    <!-- Topbar Start -->
    <div class="navbar-custom">
        <ul class="list-unstyled topnav-menu float-right mb-0">

            <li class="d-none d-sm-block">
                <form class="app-search">
                    <div class="app-search-box">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <button class="btn" type="submit">
                                    <i class="fe-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fe-bell noti-icon"></i>
                    <span class="badge badge-danger rounded-circle noti-icon-badge">9</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                                    <span class="float-right">
                                        <a href="#" class="text-dark">
                                            <small>Clear All</small>
                                        </a>
                                    </span>Notification
                        </h5>
                    </div>

                    <div class="slimscroll noti-scroll">

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item active">
                            <div class="notify-icon">
                                <img src="{{asset('assets/images/users/user-1.jpg')}}" class="img-fluid rounded-circle" alt="" /> </div>
                            <p class="notify-details">Cristina Pride</p>
                            <p class="text-muted mb-0 user-msg">
                                <small>Hi, How are you? What about our next meeting</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-primary">
                                <i class="mdi mdi-comment-account-outline"></i>
                            </div>
                            <p class="notify-details">Caleb Flakelar commented on Admin
                                <small class="text-muted">1 min ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon">
                                <img src="{{asset('assets/images/users/user-4.jpg')}}" class="img-fluid rounded-circle" alt="" /> </div>
                            <p class="notify-details">Karen Robinson</p>
                            <p class="text-muted mb-0 user-msg">
                                <small>Wow ! this admin looks good and awesome design</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-warning">
                                <i class="mdi mdi-account-plus"></i>
                            </div>
                            <p class="notify-details">New user registered.
                                <small class="text-muted">5 hours ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-info">
                                <i class="mdi mdi-comment-account-outline"></i>
                            </div>
                            <p class="notify-details">Caleb Flakelar commented on Admin
                                <small class="text-muted">4 days ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-secondary">
                                <i class="mdi mdi-heart"></i>
                            </div>
                            <p class="notify-details">Carlos Crouch liked
                                <b>Admin</b>
                                <small class="text-muted">13 days ago</small>
                            </p>
                        </a>
                    </div>

                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                        View all
                        <i class="fi-arrow-right"></i>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{asset('assets/images/users/user-1.jpg')}}" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                                Geneva <i class="mdi mdi-chevron-down"></i>
                            </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock"></i>
                        <span>Lock Screen</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                    <i class="fe-settings noti-icon"></i>
                </a>
            </li>


        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.html" class="logo text-center">
                        <span class="logo-lg">
                            <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="18">
                            <!-- <span class="logo-lg-text-light">UBold</span> -->
                        </span>
                <span class="logo-sm">
                            <!-- <span class="logo-sm-text-dark">U</span> -->
                            <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="24">
                        </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>
        </ul>
    </div>
    <!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left-side-menu">

        <div class="slimscroll-menu">

            <!--- Sidemenu -->
            <div id="sidebar-menu">

                <ul class="metismenu" id="side-menu">
                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-airplay"></i>
                            <span class="badge badge-success badge-pill float-right">4</span>
                            <span> Dashboards </span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-users"></i>
                            <span> Administracion </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="{{url('Usuario')}}">Usuarios</a>
                            </li>
                            <li>
                                <a href="{{url('PriviRol')}}">Roles Y Privilegios</a>
                            </li>
                            <li>
                                <a href="icons-dripicons.html">Permisos</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-shopping-cart"></i>
                            <span> Movimientos </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="{{url('Compras/Ingresos')}}">Compras</a>
                            </li>
                            <li>
                                <a href="{{url('Ventas')}}">Ventas</a>
                            </li>
                            <li>
                                <a href="{{url('Movimiento/Aperturacaja')}}">APERTURAR CAJA</a>
                            </li>
                            <li>
                                <a href="forms-pickers.html">Pickers</a>
                            </li>
                            <li>
                                <a href="forms-wizard.html">Wizard</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-grid"></i>
                            <span> Inventario </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="{{url('admin/Categoria')}}">Categoria</a>
                            </li>
                            <li>
                                <a href="{{url('admin/Producto')}}">Producto</a>
                            </li>
                            <li>
                                <a href="{{url('admin/Caja')}}">Caja</a>
                            </li>
                            <li>
                                <a href="{{url('admin/Caja')}}">AJUSTAR STOCK</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-bar-chart-2"></i>
                            <span>Reportes</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="charts-flot.html">Historial Ventas</a>
                            </li>
                            <li>
                                <a href="charts-morris.html">Historial compras</a>
                            </li>
                            <li>
                                <a href="charts-chartjs.html">Productos mas vendidos</a>
                            </li>
                            <li>
                                <a href="charts-chartjs.html">Productos menos vendidos</a>
                            </li>
                            <li>
                                <a href="charts-chartjs.html">Productos Faltantes</a>
                            </li>
                            <li>
                                <a href="charts-chartjs.html">Ganancias</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-map"></i>
                            <span> Maps </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="maps-google.html">Google Maps</a>
                            </li>
                            <li>
                                <a href="maps-vector.html">Vector Maps</a>
                            </li>
                            <li>
                                <a href="maps-mapael.html">Mapael Maps</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-folder-plus"></i>
                            <span> Multi Level </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level nav" aria-expanded="false">
                            <li>
                                <a href="javascript: void(0);">Level 1.1</a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" aria-expanded="false">Level 1.2
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-third-level nav" aria-expanded="false">
                                    <li>
                                        <a href="javascript: void(0);">Level 2.1</a>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);">Level 2.2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>


                </ul>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
             @yield('contenido')
                <!-- start page title -->
                <!-- end row -->
            </div> <!-- container -->
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        2015 - 2019 &copy; UBold theme by <a href="#">Coderthemes</a>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="javascript:void(0);">About Us</a>
                            <a href="javascript:void(0);">Help</a>
                            <a href="javascript:void(0);">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="right-bar-toggle float-right">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0 text-white">Settings</h5>
    </div>
    <div class="slimscroll-menu">
        <!-- User box -->
        <div class="user-box">
            <div class="user-img">
                <img src="{{asset('assets/images/users/user-1.jpg')}}" alt="user-img" title="Mat Helme" class="rounded-circle img-fluid">
                <a href="javascript:void(0);" class="user-edit"><i class="mdi mdi-pencil"></i></a>
            </div>

            <h5><a href="javascript: void(0);">Geneva Kennedy</a> </h5>
            <p class="text-muted mb-0"><small>Admin Head</small></p>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h5 class="pl-3">Basic Settings</h5>
        <hr class="mb-0" />

        <div class="p-3">
            <div class="checkbox checkbox-primary mb-2">
                <input id="Rcheckbox1" type="checkbox" checked>
                <label for="Rcheckbox1">
                    Notifications
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-2">
                <input id="Rcheckbox2" type="checkbox" checked>
                <label for="Rcheckbox2">
                    API Access
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-2">
                <input id="Rcheckbox3" type="checkbox">
                <label for="Rcheckbox3">
                    Auto Updates
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-2">
                <input id="Rcheckbox4" type="checkbox" checked>
                <label for="Rcheckbox4">
                    Online Status
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-0">
                <input id="Rcheckbox5" type="checkbox" checked>
                <label for="Rcheckbox5">
                    Auto Payout
                </label>
            </div>
        </div>

        <!-- Timeline -->
        <hr class="mt-0" />
        <h5 class="px-3">Messages <span class="float-right badge badge-pill badge-danger">25</span></h5>
        <hr class="mb-0" />
        <div class="p-3">
            <div class="inbox-widget">
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="{{asset('assets/images/users/user-2.jpg')}}" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Tomaslau</a></p>
                    <p class="inbox-item-text">I've finished it! See you so...</p>
                </div>
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="{{asset('assets/images/users/user-3.jpg')}}" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Stillnotdavid</a></p>
                    <p class="inbox-item-text">This theme is awesome!</p>
                </div>
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="{{asset('assets/images/users/user-4.jpg')}}" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Kurafire</a></p>
                    <p class="inbox-item-text">Nice to meet you</p>
                </div>

                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="{{asset('assets/images/users/user-5.jpg')}}" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Shahedk</a></p>
                    <p class="inbox-item-text">Hey! there I'm available...</p>
                </div>
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="{{asset('assets/images/users/user-6.jpg')}}" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Adhamdannaway</a></p>
                    <p class="inbox-item-text">This theme is awesome!</p>
                </div>
            </div> <!-- end inbox-widget -->
        </div> <!-- end .p-3-->

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- Vendor js -->
<script src="{{asset('assets/js/vendor.min.js')}}"></script>
<script src="{{asset('assets/js/app.min.js')}}"></script>
<!-- Plugins js-->
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- App js
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{asset('assets/libs/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.select.min.js')}}"></script>

<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/libs/custombox/custombox.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://github.com/CodeSeven/toastr/blob/master/nuget/content/scripts/toastr.js"></script>
<script src="{{asset('assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
<!-- Init js-->
<script src="{{asset('assets/libs/ladda/spin.js')}}"></script>
<script src="{{asset('assets/libs/ladda/ladda.js')}}"></script>

<!-- Buttons init js-->
<script src="{{asset('assets/js/pages/loading-btn.init.js')}}"></script>
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('assets/libs/clockpicker/bootstrap-clockpicker.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script>



<!-- App js -->



<!-- Sweet alert init js-->


<!-- toastr init js-->
@yield('script')

</body>

<!-- Mirrored from coderthemes.com/ubold/layouts/light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Feb 2020 04:58:41 GMT -->
</html>
