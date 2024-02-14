<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'SkinClinic MLM') }}</title>

<!-- Styles -->
<link
    href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
    rel="stylesheet">
<link rel="apple-touch-icon" href="{{ asset('public/backend-assets/images/ico/apple-icon-120.html') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/backend-assets/images/logo-demo.png') }}">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css"
    href="{{ asset('public/backend-assets/app-assets/vendors/css/vendors.min.css') }}">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('public/backend-assets/app-assets/css/bootstrap.css') }}">
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('public/backend-assets/app-assets/css/bootstrap-extended.css') }}"> -->
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('public/backend-assets/app-assets/css/colors.css') }}"> -->
<link rel="stylesheet" type="text/css" href="{{ asset('public/backend-assets/app-assets/css/components.css') }}">
<!-- END: Theme CSS-->

<!-- BEGIN: Page CSS-->
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('public/backend-assets/app-assets/css/core/menu/menu-types/vertical-menu-modern.css') }}"> -->
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('public/backend-assets/app-assets/css/core/colors/palette-gradient.css') }}"> -->
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('public/backend-assets/app-assets/fonts/simple-line-icons/style.min.css') }}"> -->
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('public/backend-assets/app-assets/css/pages/card-statistics.css') }}"> -->
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('public/backend-assets/app-assets/css/pages/vertical-timeline.css') }}"> -->

<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->
<!-- <link rel=" stylesheet" type="text/css" href="{{ asset('public/backend-assets/assets/css/style.css') }}"> -->
<!-- END: Custom CSS-->



{{-- fontawesome --}}

{{-- fontawesome --}}

{{-- multi-select --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.9/css/bootstrap-select.css" /> --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Kapella Theme CSS -->
<link rel=" stylesheet" type="text/css" href="{{ asset('public/backend-assets/css/style.css') }}">
<link rel=" stylesheet" type="text/css" href="{{ asset('public/backend-assets/css/materialdesignicons.min.css') }}">
<link rel=" stylesheet" type="text/css" href="{{ asset('public/backend-assets/css/vendor.bundle.base.css') }}">
<link rel=" stylesheet" type="text/css" href="{{ asset('public/backend-assets/css/_horizontal-menu.scss') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.9.97/css/materialdesignicons.min.css"
    integrity="sha512-PhzMnIL3KJonoPVmEDTBYz7rxxne7E3Lc5NekqcT3nxSLRTN2h2bJKStWoy0RfS31Jd6nBguC32sL6iK1k2OXw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel=" stylesheet" type="text/css" href="{{ asset('public/backend-assets/vendors/css/datatables.min.css') }}">
{{-- Date Time jquery --}}
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
{{--bootstrap - tagsinput --}}

<link rel="stylesheet" type="text/css" href="{{ asset('public/backend-assets/assets/css/bootstrap-tagsinput.css') }}">
<link rel=" stylesheet" type="text/css" href="{{ asset('public/frontend-assets/css/magnific-popup.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend-assets/css/toastr.min.css') }}">
<style>
    .btn-primary {
        border-color: #005456 !important;
    }

    thead input {
        width: 100%;
    }

    thead th.action input,
    thead th.file_uploaded input {
        display: none !important;
    }

    select.form-control {
        padding: 0.875rem 1.375rem !important;
    }

    table {
        width: 100% !important;
    }

    /* .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn){
			width:100%;
		} */

    
</style>