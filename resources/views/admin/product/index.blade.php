@extends('adminlte::page')

@section('title', 'index')

@section('content_header')
    <h1>Index</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{route('admin.product.create')}}" class="btn btn-primary">New product</a>
        </div>
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
                            <td><a href="{{route('admin.product.edit',$product)}}" class="btn btn-warning btn-sm">Edit</a> </td>
                            <td>
                                <form action="{{route('admin.product.destroy',$product)}}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                </form>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script src="/js/Charts/prueba.js"> </script>
{{--    <script src="/js/Charts/SalesPredictChart.js"> </script>--}}
@stop
