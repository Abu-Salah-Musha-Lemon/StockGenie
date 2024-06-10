<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Abu Salah Musha Lemon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="images/favicon.ico">
    <title>Genie</title>

    <!-- Base CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.6.0/css/searchBuilder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">

    <!-- Font Icons -->
    <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/ionicon/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/material-design-iconic-font.min.css') }}" rel="stylesheet">

    <!-- Animate CSS -->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">

    <!-- Waves-effect -->
    <link href="{{ asset('css/waves-effect.css') }}" rel="stylesheet">

    <!-- Custom Files -->
    <link href="{{ asset('css/helper.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link href="{{ asset('assets/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css">

    <script src="{{ asset('js/modernizr.min.js') }}"></script>
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            padding: 0 !important;
            cursor: pointer;
            color: inherit !important;
            border: 1px solid transparent;
            background-color: none;
        }
    </style>
</head>

<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <a href="{{ URL::to('/') }}" class="logo">
                        <img style="width: 70px; height: 70px; padding: 6px;" src="{{ asset('images/logo/StockGenie.png') }}" alt="Logo">
                    </a>
                </div>
            </div>
            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="">

                        <div class="pull-left">
                            <button class="button-menu-mobile open-left">
                                <i class="fa fa-bars"></i>
                            </button>
                            <span class="clearfix"></span>
                        </div>

                        <ul class="nav navbar-nav navbar-right pull-right">
                            <li class="hidden-xs">
                                <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="md md-crop-free"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
                                    <div>{{ Auth::user()->name }}</div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('profile.edit') }}"><i class="md md-face-unlock"></i> {{ __('Profile') }}</a></li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <li><a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"><i class="md md-settings-power"></i> {{ __('Log Out') }}</a></li>
                                    </form>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

        <!-- Left Sidebar Start -->
        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <div class="user-details">
                    <div class="pull-left">
                        <img src="#" alt="" class="thumb-md img-circle">
                    </div>
                    <div class="user-info">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('profile.edit') }}"><i class="md md-face-unlock"></i> {{ __('Profile') }}</a></li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <li><a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"><i class="md md-settings-power"></i> {{ __('Log Out') }}</a></li>
                                </form>
                            </ul>
                        </div>
                        <p class="text-muted m-0">Administrator</p>
                    </div>
                </div>
                <!-- Divider -->
                <div id="sidebar-menu">
                  @include('sideBar')
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pull-left page-title">Welcome</h4>
                            <ol class="breadcrumb pull-right">
                                <li><a href="{{ URL::to('/') }}">Genie</a></li>
                                <li><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>">Home</a></li>
                                <?php if (isset($_SERVER['PATH_INFO'])): ?>
                                    <?php $path_info = ($_SERVER['PATH_INFO'])?>
                                    <li class="active"><?php echo trim($path_info, '/'); ?></li>
                                <?php endif; ?>
                            </ol>
                        </div>
                    </div>

                    <div class="">
                        @yield('main');
                    </div>

                </div> <!-- container -->
            </div> <!-- content -->

            <footer class="footer text-right">
                © <?php echo date('Y')?> Developed By ASMLemon
            </footer>

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/waves.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('assets/jquery-detectmobile/detect.js') }}"></script>
    <script src="{{ asset('assets/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('assets/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/jquery-blockui/jquery.blockUI.js') }}"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/searchbuilder/1.6.0/js/dataTables.searchBuilder.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <!-- Toastr for notifications -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- CUSTOM JS -->
    <script src="{{ asset('js/jquery.app.js') }}"></script>
    <script src="{{asset('assets/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/datatables/dataTables.bootstrap.js')}}"></script>
    <script>
        /* Toastr Notifications */
        $(document).ready(function () {
            @if(Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}";
                switch(type) {
                    case 'info':
                        toastr.info("{{ Session::get('message') }}");
                        break;
                    case 'success':
                        toastr.success("{{ Session::get('message') }}");
                        break;
                    case 'warning':
                        toastr.warning("{{ Session::get('message') }}");
                        break;
                    case 'danger':
                        toastr.warning("{{ Session::get('message') }}");
                        break;
                    case 'error':
                        toastr.error("{{ Session::get('message') }}");
                        break;
                }
            @endif
        });
    </script>
    <script>
        /* DataTable Initialization */
        $(document).ready(function() {
            $('#dataTable').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'excel',
                    {
                        extend: 'print',
                        text: 'Print',
                        customize: function (doc) {
                            doc.content[0].text = 'Stock Genie';
                            doc.content[1].image = 'data:image/png;base64,...'; // Replace with your logo's base64 data
                            doc.content[2].text = 'Visit our website: stock Genie';
                            doc.content[2].link = 'http://www.StockGenie.com';
                            doc.content[2].color = '#007bff'; // Customize link color
                        }
                    }
                ]
            });
        });
    </script>
    <script>
        /* Image Preview */
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @yield('script');
</body>
</html>
