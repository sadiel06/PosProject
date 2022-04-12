@extends('adminlte::page')

@section('title', 'edit')

@section('content_header')
    <h1>edit</h1>
@stop

@section('content')
    @if(session('message'))
        <div class="alert alert-success">
            <strong>
                {{session('message')}}
            </strong>
        </div>
    @endif


    <div class="card">
        <div class="card-body">
            <div class="form-group">

                {!! Form::model($product,['route'=>['admin.product.update',$product],'method'=>'put']) !!}

                <div class="form-group">
                    {!! Form::label('name','Name') !!}
                    {!! Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Name of product']) !!}
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('category','Category') !!}
                    {!! Form::text('category',null,['class'=>'form-control','placeholder'=>'Category of product']) !!}
                    @error('category')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('price','Price') !!}
                    {!! Form::number('price',null,['class'=>'form-control','placeholder'=>'Price of product']) !!}
                    @error('price')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('stock','Stock') !!}
                    {!! Form::number('stock',null,['class'=>'form-control','placeholder'=>'Stock of product']) !!}
                    @error('stock')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                {!! Form::submit('Update product',['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
