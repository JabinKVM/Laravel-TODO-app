@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex align-items-center justify-content-between">

            <div>

                <h4 class="mb-1">
                    Admin Dashboard
                </h4>

                <p class="text-muted mb-0">
                    Welcome back,
                    <strong>{{ Auth::user()->name }}</strong>
                </p>

            </div>

        </div>

    </div>

</div>

{{-- Statistics --}}

<div class="row">

    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">
                            Total Users
                        </p>

                        <h3>
                            {{ $totalUsers }}
                        </h3>

                    </div>

                    <div class="avatar-sm rounded-circle bg-primary align-self-center">

                        <span class="avatar-title rounded-circle bg-primary">

                            <i class="bx bx-user font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">
                            Active Users
                        </p>

                        <h3 class="text-success">
                            {{ $activeUsers }}
                        </h3>

                    </div>

                    <div class="avatar-sm rounded-circle bg-success align-self-center">

                        <span class="avatar-title rounded-circle bg-success">

                            <i class="bx bx-check-circle font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">
                            Blocked Users
                        </p>

                        <h3 class="text-danger">
                            {{ $blockedUsers }}
                        </h3>

                    </div>

                    <div class="avatar-sm rounded-circle bg-danger align-self-center">

                        <span class="avatar-title rounded-circle bg-danger">

                            <i class="bx bx-block font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">
                            Total Tasks
                        </p>

                        <h3>
                            {{ $totalTasks }}
                        </h3>

                    </div>

                    <div class="avatar-sm rounded-circle bg-info align-self-center">

                        <span class="avatar-title rounded-circle bg-info">

                            <i class="bx bx-task font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- Charts --}}

<div class="row">

    <div class="col-lg-6">

        <div class="card">

            <div class="card-header">

                <h4 class="card-title mb-0">
                    Task Status
                </h4>

            </div>

            <div class="card-body">

                <div id="taskStatusChart" style="height:320px;"></div>

            </div>

        </div>

    </div>

    <div class="col-lg-6">

        <div class="card">

            <div class="card-header">

                <h4 class="card-title mb-0">
                    Task Priority
                </h4>

            </div>

            <div class="card-body">

                <div id="taskPriorityChart" style="height:320px;"></div>

            </div>

        </div>

    </div>

</div>
<div class="row">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-header">

                <h4 class="card-title mb-0">
                    Recent Users
                </h4>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead>

                            <tr>

                                <th>Name</th>

                                <th>Email</th>

                                <th>Status</th>

                                <th>Joined</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($recentUsers as $user)

                            <tr>

                                <td>{{ $user->name }}</td>

                                <td>{{ $user->email }}</td>

                                <td>

                                    @if($user->status == 'blocked')

                                        <span class="badge bg-danger">
                                            Blocked
                                        </span>

                                    @else

                                        <span class="badge bg-success">
                                            Active
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    {{ $user->created_at->format('d M Y') }}

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<script>

document.addEventListener("DOMContentLoaded", function () {

    // ===========================
    // TASK STATUS BAR CHART
    // ===========================

    var statusChart = new ApexCharts(
        document.querySelector("#taskStatusChart"),
        {
            chart: {
                type: 'bar',
                height: 320,
                toolbar: {
                    show: false
                }
            },

            colors: ['#556ee6'],

            series: [{
                name: 'Tasks',
                data: [
                    {{ $completedTasks }},
                    {{ $pendingTasks }}
                ]
            }],

            xaxis: {
                categories: [
                    'Completed',
                    'Pending'
                ]
            },

            plotOptions: {
                bar: {
                    borderRadius: 6,
                    columnWidth: '45%'
                }
            },

            dataLabels: {
                enabled: true
            },

            grid: {
                borderColor: '#f1f1f1'
            }
        }
    );

    statusChart.render();

    // ===========================
    // TASK PRIORITY PIE CHART
    // ===========================

    var priorityChart = new ApexCharts(
        document.querySelector("#taskPriorityChart"),
        {
            chart: {
                type: 'pie',
                height: 320
            },

            labels: [
                'High',
                'Medium',
                'Low'
            ],

            series: [
                {{ $highPriority }},
                {{ $mediumPriority }},
                {{ $lowPriority }}
            ],

            colors: [
                '#f46a6a',
                '#f1b44c',
                '#34c38f'
            ],

            legend: {
                position: 'bottom'
            },

            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        }
    );

    priorityChart.render();

});

</script>

@endpush