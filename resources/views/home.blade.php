@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sistema de Administración de laboratorio Geotecnico</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generar reportes</a>
        </div>



        <!-- Content Row -->
        <div class="row">


            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Proyectos Realizados</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <span id="total-usuarios-activos">
                                        {{ $total_proyectos }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tasks fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card  border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total de Muestras</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <span id="total-usuarios-activos">
                                        {{ $total_muestras }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-flask fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="chart-container">
            <canvas id="myChart" width="500" height="200"></canvas>
        </div>


    </div>

@endsection

<script src="{{ asset('admin/vendor/chart.js/Chart.js') }}"></script>
<script>
    var datos = @json($sondeosPorMes);

    var meses = datos.map(function(item) {
        return item.mes;
    });

    var totales = datos.map(function(item) {
        return item.total;
    });

    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Total de Sondeos por Mes',
                    data: totales,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 10
                    }
                }
            }
        });
    });
</script>
