<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
    <meta name="theme-color" content="#42B549">
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ URL::asset('foto/favicon.png') }}">
    <title>Admin | @yield('title')</title>

    <!-- wysiwyg-editor-master -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard-material/plugins/wysiwyg-editor-master/froala_editor.pkgd.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard-material/plugins/wysiwyg-editor-master/froala_style.min.css') }}">
    <!-- end-wysiwyg-editor-master -->
    
	<!-- babat -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="{{ URL::asset('dashboard-material/css/SelectwithThumbnails/bootstrap-select.css') }}">
	<!-- end babat -->

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('dashboard-material/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('dashboard-material/plugins/html5-editor/bootstrap-wysihtml5.css') }}" />
    <link href="{{ URL::asset('dashboard-material/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
	<!-- Popup CSS -->
    <link href="{{ URL::asset('dashboard-material/plugins/Magnific-Popup-master/dist/magnific-popup.css') }}" rel="stylesheet">
    <!-- Page plugins css -->
    <link href="{{ URL::asset('dashboard-material/plugins/clockpicker/dist/jquery-clockpicker.min.css') }}" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="{{ URL::asset('dashboard-material/plugins/jquery-asColorPicker-master/css/asColorPicker.css') }}" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="{{ URL::asset('dashboard-material/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="{{ URL::asset('dashboard-material/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dashboard-material/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- xeditable css -->
    <link href="{{ URL::asset('dashboard-material/plugins/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet" />
    <!-- chartist CSS -->
    <link href="{{ URL::asset('dashboard-material/plugins/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dashboard-material/plugins/chartist-js/dist/chartist-init.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dashboard-material/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dashboard-material/plugins/css-chart/css-chart.css') }}" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="{{ URL::asset('dashboard-material/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <!--This page css - Morris CSS -->
    <link href="{{ URL::asset('dashboard-material/plugins/c3-master/c3.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
	<!-- <link href="{{ URL::asset('dashboard-material/css/style.css') }}" rel="stylesheet"> -->
	<link href="{{ URL::asset('dashboard-material/css/style_benihbaik.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
	<link href="{{ URL::asset('dashboard-material/css/colors/benihbaik.css') }}" id="theme" rel="stylesheet">
	<!-- select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->


	@yield('css')

	<style>
		input[type=number]::-webkit-inner-spin-button, 
		input[type=number]::-webkit-outer-spin-button { 
		-webkit-appearance: none; 
		margin: 0; 
        }
        
	</style>

</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('partials.admin.header')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('partials.admin.sidebar')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
            Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> 
                        Tech Insider Clothing
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ URL::asset('dashboard-material/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ URL::asset('dashboard-material/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard-material/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ URL::asset('dashboard-material/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ URL::asset('dashboard-material/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ URL::asset('dashboard-material/js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ URL::asset('dashboard-material/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard-material/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ URL::asset('dashboard-material/js/custom.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard-material/plugins/moment/moment.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dashboard-material/plugins/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js') }}"></script>
    <script src="{{ URL::asset('dashboard-material/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="{{ URL::asset('dashboard-material/plugins/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="{{ URL::asset('dashboard-material/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js') }}"></script>
    <script src="{{ URL::asset('dashboard-material/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js') }}"></script>
    <script src="{{ URL::asset('dashboard-material/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js') }}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ URL::asset('dashboard-material/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="{{ URL::asset('dashboard-material/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard-material/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- This is data table -->
    <script src="{{ URL::asset('dashboard-material/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->

    <!-- wysuhtml5 Plugin JavaScript -->
    <script src="{{ URL::asset('dashboard-material/plugins/html5-editor/wysihtml5-0.3.0.js') }}"></script>
    <script src="{{ URL::asset('dashboard-material/plugins/html5-editor/bootstrap-wysihtml5.js') }}"></script>

    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="{{ URL::asset('dashboard-material/js/jasny-bootstrap.js') }}"></script>
    <!-- chartist chart -->
    <script src="{{ URL::asset('dashboard-material/plugins/chartist-js/dist/chartist.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard-material/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <!-- Vector map JavaScript -->
    <script src="{{ URL::asset('dashboard-material/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard-material/plugins/vectormap/jquery-jvectormap-us-aea-en.js') }}"></script>
    <script src="{{ URL::asset('dashboard-material/js/dashboard3.js') }}"></script>
    <!--c3 JavaScript -->
    <script src="{{ URL::asset('dashboard-material/plugins/d3/d3.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard-material/plugins/c3-master/c3.min.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ URL::asset('dashboard-material/js/dashboard1.js') }}"></script>
	<!-- Magnific popup JavaScript -->
    <script src="{{ URL::asset('dashboard-material/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard-material/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }}"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ URL::asset('dashboard-material/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
	<!-- select2 -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

	<!-- babat -->
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
	<script src="{{ URL::asset('dashboard-material/js/SelectwithThumbnails/bootstrap-select.js') }}"></script>
    <!-- end babat -->
    <!-- wysiwyg-editor-master -->
	<script type="text/javascript" src="{{ URL::asset('dashboard-material/plugins/wysiwyg-editor-master/froala_editor.pkgd.min.js') }}"></script>
	<!-- end-wysiwyg-editor-master -->

    @yield('js')
</body>

</html>