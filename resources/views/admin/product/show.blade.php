@extends('adminlte::page')

@section('title', 'show')

@section('content_header')
    <h1>show</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop{{--
    @extends('layouts.app')

    @section('content')
        product.show template
    @endsection
--}}
