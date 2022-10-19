@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Dashboard')

@section('content_header')
<h1>Escritorio Principal</h1>
@stop

@section('content')
<p></p>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
@stop

@section('js')
<script src="{{asset('js/plugins/sweetalert.min.js')}}"> </script>
<script src="{{asset('js/admin/validate.js')}}"> </script>
<script src="{{asset('js/admin/admin.js')}}"> </script>
<script src="{{asset('js/util.js')}}"> </script>
@stop
@include('layouts.modal')
