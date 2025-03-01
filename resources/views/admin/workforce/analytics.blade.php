@extends('layouts.app')

@section('title', 'HR Workforce Analytics')
@section('header','Workforce')
@section('active-header', 'Analytics')

@section('styles')
<style>
    .analytics-card {
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        background-color: white;
    }

    .chart-container {
        height: 300px;
        position: relative;
    }

    .stats-card {
        text-align: center;
        padding: 15px;
        border-radius: 8px;
        background-color: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .stats-value {
        font-size: 24px;
        font-weight: bold;
        margin: 10px 0;
    }

    .stats-label {
        color: #666;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
<div class="ecommerce-widget">
    {{-- <h1 class="mb-4 text-center">HR Workforce Analytics Dashboard</h1> --}}

    <div class="row">
        <!-- Attendance Overview -->
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Attendance Overview</h5>
                <div class="card-body">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Performance Metrics -->
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Average Performance</h5>
                <div class="card-body">
                    <canvas id="performanceChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Department Distribution -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Department Distribution</h5>
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                        <canvas id="departmentPieChart"></canvas>
                    </div>
                    <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12 col-12">
                        <canvas id="departmentBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="row">
        <!-- Total Employee -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Total Employee</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">4</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Helpdesk Tickets -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Average Rating</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">0</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Claims & Reimbursement -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Attendance Rate</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">92.5%</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Hires -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">New Hires</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">0</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dummy Data
    const performanceData = {
        names: ['Q1', 'Q2', 'Q3', 'Q4'],
        ratings: [3.8, 4.1, 3.9, 4.2],
        projects: [42, 45, 40, 48]
    };

    const attendanceData = {
        months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        present: [22, 20, 21, 20, 19, 21],
        leaves: [1, 0, 2, 2, 3, 1]
    };

    const departmentData = {
        names: ['Engineering', 'Sales', 'Marketing', 'HR'],
        values: [30, 20, 15, 10]
    };

    // Performance Chart
    const performanceCtx = document.getElementById('performanceChart').getContext('2d');
    const performanceChart = new Chart(performanceCtx, {
        type: 'line',
        data: {
            labels: performanceData.names,
            datasets: [
                {
                    label: 'Performance Rating',
                    data: performanceData.ratings,
                    borderColor: '#8884d8',
                    backgroundColor: 'rgba(136, 132, 216, 0.1)',
                    yAxisID: 'y',
                },
                {
                    label: 'Projects Completed',
                    data: performanceData.projects,
                    borderColor: '#82ca9d',
                    backgroundColor: 'rgba(130, 202, 157, 0.1)',
                    yAxisID: 'y1',
                }
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Performance Rating'
                    },
                    min: 0,
                    max: 5
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    grid: {
                        drawOnChartArea: false,
                    },
                    title: {
                        display: true,
                        text: 'Projects Completed'
                    }
                }
            }
        }
    });

    // Attendance Chart
    const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
    const attendanceChart = new Chart(attendanceCtx, {
        type: 'bar',
        data: {
            labels: attendanceData.months,
            datasets: [
                {
                    label: 'Days Present',
                    data: attendanceData.present,
                    backgroundColor: '#0088FE',
                },
                {
                    label: 'Leaves Taken',
                    data: attendanceData.leaves,
                    backgroundColor: '#FF8042',
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false
                }
            }
        }
    });

    // Department Pie Chart
    const departmentPieCtx = document.getElementById('departmentPieChart').getContext('2d');
    const departmentPieChart = new Chart(departmentPieCtx, {
        type: 'pie',
        data: {
            labels: departmentData.names,
            datasets: [
                {
                    data: departmentData.values,
                    backgroundColor: ['#0088FE', '#00C49F', '#FFBB28', '#FF8042'],
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Department Bar Chart
    const departmentBarCtx = document.getElementById('departmentBarChart').getContext('2d');
    const departmentBarChart = new Chart(departmentBarCtx, {
        type: 'bar',
        data: {
            labels: departmentData.names,
            datasets: [
                {
                    label: 'Employees',
                    data: departmentData.values,
                    backgroundColor: ['#0088FE', '#00C49F', '#FFBB28', '#FF8042'],
                }
            ]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>
@endsection
