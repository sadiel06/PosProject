@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>

@stop

@section('content')
<div class="row" >
    <div class="card col m-lg-3" style="max-width: 600px">
        <canvas style="max-height: 900px; max-width: 600px" class="" id="myChart"></canvas>
    </div>

    <div class="card col m-lg-3" style="max-width: 600px">
        <canvas style="max-height: 900px; max-width: 600px" class="" id="yourChart"></canvas>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 7, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {

                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        myChart.canvas.parentNode.style.height = 'auto';
        myChart.canvas.parentNode.style.width = 'auto';

        //otro char


        const ctx1 = document.getElementById('yourChart').getContext('2d');
        const yourChart = new Chart(ctx1, {
            type: 'polarArea',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 7, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {

                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        yourChart.canvas.parentNode.style.height = 'auto';
        yourChart.canvas.parentNode.style.width = 'auto';

    </script>
@stop
