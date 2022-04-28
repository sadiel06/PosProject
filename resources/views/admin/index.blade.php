@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<div class="row justify-content-center">
    <div class="col-10">
        <div class="card card-gray">
            <div class="card-header">
                <h3 class="card-title">Predicción de ventas</h3>
                <div class="card-tools">
                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <canvas  class="" id="predictChart"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-4 ">
        <div class="card card-dark ">
            <div class="card-header">
                <h3 class="card-title">Ventas semanales</h3>
                <div class="card-tools">
                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-tool"  data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <canvas  class="" id="ventasChart"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class=" col-4  ">
        <div class="card card-blue">
            <div class="card-header">
                <h3 class="card-title">Productos mas vendidos</h3>
                <div class="card-tools">
                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <canvas  class="" id="productChart"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-4  ">
        <div class="card card-green">
            <div class="card-header">
                <h3 class="card-title">Sizes mas demandados</h3>
                <div class="card-tools">
                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <canvas  class="" id="sizeChart"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="row">
    <div class="small-box bg-info col m-3 p-0">
        <div class="inner">
            <h3>3</h3>
            <p>Sucursales</p>
        </div>
        <div class="icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <a href="#" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
    <div class="small-box bg-gradient-success col m-3 p-0">
        <div class="inner">
            <h3>44</h3>
            <p>Empleados</p>
        </div>
        <div class="icon">
            <i class="fas fa-user-alt"></i>
        </div>
        <a href="#" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
    <div class="small-box bg-danger col m-3 p-0">
        <div class="inner">
            <h3>15</h3>
            <p>Productos con bajo stock</p>
        </div>
        <div class="icon">
            <i class="fas fa-solid fa-cubes"></i>
        </div>
        <a href="#" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
</div>

<div class="row">
    {{--    tabla de stock--}}
    <div class="col">
        <div class="card card-cyan">
            <div class="card-header">
                <h3 class="card-title">Stock de productos</h3>
                <div class="card-tools">
                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {{-- tabla--}}
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
            <!-- /.card-body -->
        </div>
    </div>
</div>
<!-- /.card -->
@stop

@section('css')

@stop
@section('js')
    <script src="/js/Charts/SalesChart.js"> </script>
    <script src="/js/Charts/SalesPredictChart.js"> </script>
    <script src="/js/Charts/ProductsChart.js"> </script>
    <script src="/js/Charts/SizesChart.js"> </script>
    <script >
        let api = <?php echo json_encode( Illuminate\Support\Facades\Http::get('http://127.0.0.1:5000/clients')->body()); ?>;
        api = JSON.parse(api);
        console.log(api.totales);
        const ctx3 = document.getElementById('predictChart').getContext('2d');
        const theirChart1 = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Nobiembre', 'Diciembre'],
                datasets: [{
                    label: ['# Prediccion(90.1%)'],
                    data:[373636.66, 380042.73, 306457.52, 275514.02,308310.45],
                    backgroundColor:'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                },{
                    label: '# Ventas por mes',
                    data: api.totales.slice(api.totales.length-4),
                    backgroundColor:'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                }]
            },
        });
        theirChart1.canvas.parentNode.style.height = 'auto';
        theirChart1.canvas.parentNode.style.width = 'auto';

    </script>
@stop
