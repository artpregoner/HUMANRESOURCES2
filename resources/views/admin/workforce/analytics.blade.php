@extends('layouts.app')

@section('title', 'HR Workforce Analytics')
@section('breadcrumbs')
    <flux:breadcrumbs.item :href="route('admin.workforce.index')">Workforce</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('admin.workforce.index')">Analytics</flux:breadcrumbs.item>
@endsection

@section('content')
<div class="p-4">
    <div class="space-y-6">
        <!-- Charts Row -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Attendance Overview -->
            <div class="bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h5 class="text-lg font-semibold text-gray-700 dark:text-gray-100">Attendance Overview</h5>
                </div>
                <div class="p-4">
                    <div class="h-[300px] relative">
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Performance Metrics -->
            <div class="bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h5 class="text-lg font-semibold text-gray-700 dark:text-gray-100">Average Performance</h5>
                </div>
                <div class="p-4">
                    <div class="h-[300px] relative">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Department Distribution -->
        <div class="bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-lg font-semibold text-gray-700 dark:text-gray-100">Department Distribution</h5>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-1 gap-6 xl:grid-cols-12">
                    <div class="xl:col-span-4">
                        <canvas id="departmentPieChart"></canvas>
                    </div>
                    <div class="xl:col-span-8">
                        <canvas id="departmentBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Stats -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @php
                $summaryCards = [
                    ['label' => 'Total Employee', 'value' => 4],
                    ['label' => 'Average Rating', 'value' => 0],
                    ['label' => 'Attendance Rate', 'value' => '92.5%'],
                    ['label' => 'New Hires', 'value' => 0],
                ];
            @endphp

            @foreach($summaryCards as $card)
            <div class="bg-white border-t-4 border-blue-600 rounded-lg shadow-md dark:bg-gray-800">
                <div class="p-4">
                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $card['label'] }}</h5>
                    <div class="mt-2">
                        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $card['value'] }}</h1>
                    </div>
                </div>
            </div>
            @endforeach
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
            maintainAspectRatio: false,
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
            maintainAspectRatio: false,
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
