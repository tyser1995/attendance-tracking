<!--
=========================================================
 Paper Dashboard - v2.0.0
=========================================================

 Product Page: https://www.creative-tim.com/product/paper-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 UPDIVISION (https://updivision.com)
 Licensed under MIT (https://github.com/creativetimofficial/paper-dashboard/blob/master/LICENSE)

 Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images') }}/no_logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Extra details for Live View on GitHub Pages -->

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- <script src="{{asset('adminlte')}}/js/plugin/webfont/webfont.min.js"></script> -->
	<!-- <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/summernote/summernote-bs4.min.css"> -->
	<!-- <script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../adminlte/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script> -->

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/fontawesome-free/css/all.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/jqvmap/jqvmap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{asset('adminlte')}}/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="{{asset('adminlte')}}/plugins/summernote/summernote-bs4.min.css">

    <!-- CSS Files -->
	<!-- <link rel="stylesheet" href="{{asset('adminlte')}}/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{asset('adminlte')}}/css/adminlte.min.css">-->
	<link rel="stylesheet" href="{{asset('/')}}css/global.css"> 

    <!-- {{-- <link rel="stylesheet" href="{{asset('adminlte')}}/css/demo.css"> --}} -->
	<!-- Toastr -->
  	<link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/toastr/toastr.min.css">

    <!-- CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" /> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
	
    <!-- <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script> -->

	<!-- FullCalendar -->
	<!-- <link href='https://cdn.jsdelivr.net/npm/fullcalendar/core/main.min.css' rel='stylesheet' />
	<link href='https://cdn.jsdelivr.net/npm/fullcalendar/daygrid/main.min.css' rel='stylesheet' />

	<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
	<script src='https://cdn.jsdelivr.net/npm/fullcalendar/core@6.1.15/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/daygrid@6.1.15/index.global.min.js'></script>
	<script src='https://cdn.jsdelivr.net/npm/fullcalendar/interaction/main.min.js'></script> -->
	
     <!-- daterange picker -->
  	<!-- <link rel="stylesheet" href="{{asset('adminlte')}}/plugins/daterangepicker/daterangepicker.css"> -->

	<!-- <script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
	<script src="{{ asset('js/print.js') }}"></script> -->
		<style>
		body {
			background-image: url("{{ asset('images/logo/main_bg.jpg') }}");
			background-repeat: no-repeat;   /* Prevents tiling */
			background-size: cover;        /* Stretches to fill screen */
			background-position: center;   /* Centers the image */
		}
	</style>
</head>

<x-head.tinymce-config />
<body class="hold-transition sidebar-mini layout-fixed {{ $class }}" >

    @auth()
        @include('layouts.page_templates.auth')
    @endauth

    @guest
    	@include('layouts.page_templates.guest')
    @endguest

    {{-- <script src="{{ asset('service-worker.js') }}"></script>
    <script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("service-worker.js").then(function(reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
    </script> --}}

	<!-- jQuery -->
	<script src="{{asset('adminlte')}}/plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{asset('adminlte')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="{{asset('adminlte')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- DataTables  & Plugins -->
	<script src="{{asset('adminlte')}}/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="{{asset('adminlte')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="{{asset('adminlte')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="{{asset('adminlte')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="{{asset('adminlte')}}/plugins/jszip/jszip.min.js"></script>
	<script src="{{asset('adminlte')}}/plugins/pdfmake/pdfmake.min.js"></script>
	<script src="{{asset('adminlte')}}/plugins/pdfmake/vfs_fonts.js"></script>
	<script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
	<script src="{{asset('adminlte')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
	<!-- ChartJS -->
	<script src="{{asset('adminlte')}}/plugins/chart.js/Chart.min.js"></script>
	<!-- Sparkline -->
	<script src="{{asset('adminlte')}}/plugins/sparklines/sparkline.js"></script>
	<!-- JQVMap -->
	<script src="{{asset('adminlte')}}/plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="{{asset('adminlte')}}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="{{asset('adminlte')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="{{asset('adminlte')}}/plugins/moment/moment.min.js"></script>
	<script src="{{asset('adminlte')}}/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="{{asset('adminlte')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="{{asset('adminlte')}}/plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="{{asset('adminlte')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="{{asset('adminlte')}}/js/adminlte.js"></script>

	<script src="{{asset('adminlte')}}/js/pages/dashboard.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- Toastr -->
    <script src="{{ asset('adminlte') }}/plugins/toastr/toastr.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		 var base_url = "{{ url('/') }}";
		var PRELOADING = "<div class='text-center'><i class='fa fa-spin fa-spinner' style='font-size: 30px'></i></div>";
		$(function() {
			$('[data-toggle="tooltip"]').tooltip();
			//autoclose alert
			$('div.alert').delay(3000).slideUp(300);
		})
		$.widget.bridge('uibutton', $.ui.button)
	</script>
    @stack('scripts')
</body>

</html>
