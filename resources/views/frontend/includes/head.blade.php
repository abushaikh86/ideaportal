<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'SkinClinic MLM') }}</title>

<!-- Styles -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
<link rel="apple-touch-icon" href="{{ asset('public/backend-assets/images/ico/apple-icon-120.html') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/backend-assets/images/logo-demo.png') }}">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('public/backend-assets/app-assets/vendors/css/vendors.min.css') }}">

<!-- BEGIN: Custom CSS-->
<link rel=" stylesheet" type="text/css" href="{{ asset('public/backend-assets/assets/css/style.css') }}">
<!-- END: Custom CSS-->

{{-- tabler theme --}}
<link rel=" stylesheet" type="text/css" href="{{ asset('public/frontend-assets/css/tabler.min.css') }}">
<link rel=" stylesheet" type="text/css" href="{{ asset('public/frontend-assets/css/tabler-flags.min.css') }}">
<link rel=" stylesheet" type="text/css" href="{{ asset('public/frontend-assets/css/tabler-payments.min.css') }}">
<link rel=" stylesheet" type="text/css" href="{{ asset('public/frontend-assets/css/tabler-vendors.min.css') }}">
<link rel=" stylesheet" type="text/css" href="{{ asset('public/frontend-assets/css/demo.min.css') }}">
<link rel=" stylesheet" type="text/css" href="{{ asset('public/backend-assets/vendors/css/datatables.min.css') }}">
<link rel=" stylesheet" type="text/css" href="{{ asset('public/frontend-assets/css/magnific-popup.css') }}">
<link rel=" stylesheet" type="text/css" href="{{ asset('public/frontend-assets/css/toastr.min.css') }}">
<link rel=" stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@php
$certificate_img_path = asset('public/frontend-assets/images/certificate.png');
@endphp

<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

{{-- Date Time jquery --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link rel=" stylesheet" type="text/css" href="{{ asset('public/frontend-assets/static/css/styles.css') }}">

<style>
    thead input {
        width: 100%;
    }

    thead th.action input,
    thead th.file_uploaded input {
        display: none !important;
    }
    select.form-control {
        padding: 0.6rem 1.375rem !important;
        -webkit-appearance: auto !important;
        -moz-appearance: auto !important;
        appearance: auto !important;
    }
</style>
