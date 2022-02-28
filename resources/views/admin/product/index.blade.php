@extends('adminlte::page')

@section('title', 'index')

@section('content_header')
    <h1>Index</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->category}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->stock}}
                            <td><a href="{{route('admin.product.edit',$product)}}" class="btn btn-outline-primary btn-sm">Edit</a> </td>
                            <td><a href="{{--route('admin.product.destroy')--}}" class="btn btn-outline-danger btn-sm">Delete</a> </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
