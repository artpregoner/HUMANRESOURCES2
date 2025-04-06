<div class="grid grid-cols-1 gap-6 xl:grid-cols-12">
    <div class="xl:col-span-12">
        <div class="pt-4 mb-2">
            <h3 class="text-2xl font-semibold text-gray-800">Claims & Reimbursement Section</h3>
        </div>
    </div>

    <!-- Claims Status Chart -->
    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12">
        <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="px-5 py-3 dark:border-gray-600">
                <h5 class="text-lg font-medium text-gray-900 dark:text-white">Claims Status</h5>
            </div>
            <div class="p-4">
                <div id="claims-status-chart" class="w-full"></div>
            </div>
        </div>
    </div>

    <!-- Claims Data -->
    <div class="xl:col-span-8 lg:col-span-6 md:col-span-6 sm:col-span-12">
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
            <!-- Claims Count List -->
            <div>
                <div class="bg-white border-t-4 border-blue-600 rounded-lg shadow dark:bg-gray-800">
                    <div class="p-4">
                        <h5 class="mb-3 text-gray-500 dark:text-gray-400">Total Count Claims</h5>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            <li class="flex items-center justify-between py-2">
                                <span class="flex items-center text-sm">
                                    <i class="mr-2 text-gray-400 fa fa-square-full"></i> Submitted
                                </span>
                                <span class="inline-flex items-center justify-center px-2 py-1 text-sm font-medium text-white bg-blue-600 rounded-full">
                                    {{ $chartData['data'][0] }}
                                </span>
                            </li>
                            <li class="flex items-center justify-between py-2">
                                <span class="flex items-center text-sm">
                                    <i class="mr-2 text-blue-400 fa fa-square-full"></i> Pending
                                </span>
                                <span class="inline-flex items-center justify-center px-2 py-1 text-sm font-medium text-white bg-blue-600 rounded-full">
                                    {{ $chartData['data'][1] }}
                                </span>
                            </li>
                            <li class="flex items-center justify-between py-2">
                                <span class="flex items-center text-sm">
                                    <i class="mr-2 text-green-500 fa fa-square-full"></i> Approved
                                </span>
                                <span class="inline-flex items-center justify-center px-2 py-1 text-sm font-medium text-white bg-blue-600 rounded-full">
                                    {{ $chartData['data'][2] }}
                                </span>
                            </li>
                            <li class="flex items-center justify-between py-2">
                                <span class="flex items-center text-sm">
                                    <i class="mr-2 text-red-500 fa fa-square-full"></i> Rejected
                                </span>
                                <span class="inline-flex items-center justify-center px-2 py-1 text-sm font-medium text-white bg-blue-600 rounded-full">
                                    {{ $chartData['data'][3] }}
                                </span>
                            </li>
                            <li class="flex items-center justify-between py-2">
                                <span class="flex items-center text-sm">
                                    <i class="mr-2 text-yellow-400 fa fa-square-full"></i> Unapproved
                                </span>
                                <span class="inline-flex items-center justify-center px-2 py-1 text-sm font-medium text-white bg-blue-600 rounded-full">
                                    {{ $chartData['data'][4] }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Total Claims, New Submitted Claims, Paid -->
            <div class="space-y-6">
                <div class="p-4 text-center bg-white border-t-4 border-blue-600 rounded-lg shadow dark:bg-gray-800">
                    <h5 class="text-gray-500 dark:text-gray-400">Total Claims</h5>
                    <h1 class="mt-1 text-3xl font-bold text-gray-800 dark:text-white">{{ $totalClaims }}</h1>
                </div>
                <div class="p-4 text-center bg-white border-t-4 border-blue-600 rounded-lg shadow dark:bg-gray-800">
                    <h5 class="text-gray-500 dark:text-gray-400">New Submitted Claims</h5>
                    <h1 class="mt-1 text-3xl font-bold text-gray-800 dark:text-white">{{ $newSubmittedClaims }}</h1>
                </div>
                <div class="p-4 text-center bg-white border-t-4 border-blue-600 rounded-lg shadow dark:bg-gray-800">
                    <h5 class="text-gray-500 dark:text-gray-400">Paid</h5>
                    <h1 class="mt-1 text-3xl font-bold text-gray-800 dark:text-white">0</h1>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>

<script>
const getClaimsStatusChartOptions = () => {
    return {
        series: [
            {{ $chartData['data'][0] }}, // Submitted
            {{ $chartData['data'][1] }}, // Pending
            {{ $chartData['data'][2] }}, // Approved
            {{ $chartData['data'][3] }}, // Rejected
            {{ $chartData['data'][4] }}  // Unapproved
        ],
        labels: ["Submitted", "Pending", "Approved", "Rejected", "Unapproved"],
        colors: ["#3B82F6", "#60A5FA", "#10B981", "#EF4444", "#FACC15"],
        chart: {
            type: 'donut',
            height: 300,
            width: "100%"
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '75%',
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontFamily: 'Inter, sans-serif',
                            offsetY: 20,
                        },
                        value: {
                            show: true,
                            fontFamily: 'Inter, sans-serif',
                            offsetY: -20,
                        },
                        total: {
                            showAlways: true,
                            show: true,
                            label: "Total",
                            fontFamily: 'Inter, sans-serif',
                            formatter: function (w) {
                                return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                            }
                        }
                    }
                }
            }
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            position: "bottom",
            fontFamily: 'Inter, sans-serif'
        }
    }
}

if (document.getElementById("claims-status-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("claims-status-chart"), getClaimsStatusChartOptions());
    chart.render();
}
</script>
@endpush

