@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-sm-flex align-items-center justify-content-between">

            <h4 class="mb-sm-0 font-size-18">

                Admin Dashboard

            </h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">

    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>
    </li>

    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">
            Admin
        </a>
    </li>

    

</ol>
                

            </div>

        </div>

    </div>

</div>
<div class="row">

    <div class="col-md-3">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">

                            Total Users

                        </p>

                        <h4>

                            {{ $totalUsers }}

                        </h4>

                    </div>

                    <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">

                        <span class="avatar-title rounded-circle bg-primary">

                            <i class="bx bx-user font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">

                            Active Users

                        </p>

                        <h4>

                            {{ $activeUsers }}

                        </h4>

                    </div>

                    <div class="avatar-sm rounded-circle bg-success align-self-center mini-stat-icon">

                        <span class="avatar-title rounded-circle bg-success">

                            <i class="bx bx-user-check font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">

                            Blocked Users

                        </p>

                        <h4>

                            {{ $blockedUsers }}

                        </h4>

                    </div>

                    <div class="avatar-sm rounded-circle bg-danger align-self-center mini-stat-icon">

                        <span class="avatar-title rounded-circle bg-danger">

                            <i class="bx bx-block font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">

                            Total Tasks

                        </p>

                        <h4>

                            {{ $totalTasks }}

                        </h4>

                    </div>

                    <div class="avatar-sm rounded-circle bg-info align-self-center mini-stat-icon">

                        <span class="avatar-title rounded-circle bg-info">

                            <i class="bx bx-task font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<div class="row">

    <div class="col-lg-6">

        <div class="card h-100">

            <div class="card-header">

                <h4 class="card-title mb-0">
                    Task Status
                </h4>

            </div>

            <div class="card-body d-flex justify-content-center align-items-center">

                <div id="taskStatusChart" style="width:100%;height:320px;"></div>

            </div>

        </div>

    </div>

    <div class="col-lg-6">

        <div class="card h-100">

            <div class="card-header">

                <h4 class="card-title mb-0">
                    Task Priority
                </h4>

            </div>

            <div class="card-body d-flex justify-content-center align-items-center">

                <div id="priorityChart" style="width:100%;height:320px;"></div>

            </div>

        </div>

    </div>

</div>
        

    <!-- Priority -->
    

            <div class="card-header">

                

            </div>

           

        </div>

    </div>

</div>
<div class="row">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-header">

                <h4 class="card-title">

                    Quick Actions

                </h4>

            </div>

            <div class="card-body">

                <a href="{{ route('admin.users') }}"
                   class="btn btn-primary">

                    <i class="bx bx-group me-1"></i>

                    Manage Users

                </a>

            </div>

        </div>

    </div>

</div>

@endsection
@section('scripts')

<script>

document.addEventListener("DOMContentLoaded", function () {

    // ===========================
    // TASK STATUS - BAR CHART
    // ===========================

    var taskStatusOptions = {

        series: [{

            name: 'Tasks',

            data: [
                {{ $completedTasks }},
                {{ $pendingTasks }}
            ]

        }],

        chart: {

            type: 'bar',

            height: 320,

            toolbar: {
                show: false
            }

        },

        plotOptions: {

            bar: {

                horizontal: false,

                columnWidth: '45%',

                borderRadius: 6

            }

        },

        dataLabels: {

            enabled: true

        },

        xaxis: {

            categories: [

                'Completed',

                'Pending'

            ]

        },

        colors: [

            '#34c38f'

        ]

    };

    var taskChart = new ApexCharts(

        document.querySelector("#taskStatusChart"),

        taskStatusOptions

    );

    taskChart.render();



    // ===========================
    // TASK PRIORITY - PIE CHART
    // ===========================

    var priorityOptions = {

        series: [

            {{ $highPriority }},

            {{ $mediumPriority }},

            {{ $lowPriority }}

        ],

        chart: {

            type: 'pie',

            height: 350

        },

        labels: [

            'High',

            'Medium',

            'Low'

        ],

        legend: {

            position: 'bottom'

        }

    };

    var priorityChart = new ApexCharts(

        document.querySelector("#priorityChart"),

        priorityOptions

    );

    priorityChart.render();

});

</script>

@endsection