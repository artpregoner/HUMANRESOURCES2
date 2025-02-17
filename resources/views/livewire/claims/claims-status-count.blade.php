<div>
    <div class="card">
        <h5 class="card-header">Claims Status Count</h5>
        <div class="card-body">
            <div x-data="{ chart: null }"
                 x-init="
                    chart = new Chart($refs.canvas.getContext('2d'), {
                        type: 'doughnut',
                        data: {
                            labels: @js($chartData['labels']),
                            datasets: [{
                                backgroundColor: @js($chartData['colors']),
                                data: @js($chartData['data'])
                            }]
                        },
                        options: {
                            legend: {
                                display: false
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        const dataset = data.datasets[tooltipItem.datasetIndex];
                                        const total = dataset.data.reduce((acc, curr) => acc + curr, 0);
                                        const currentValue = dataset.data[tooltipItem.index];
                                        const percentage = ((currentValue/total) * 100).toFixed(1);
                                        return `${data.labels[tooltipItem.index]}: ${currentValue} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    });

                    $wire.on('chartDataUpdated', (chartData) => {
                        chart.data.labels = chartData.labels;
                        chart.data.datasets[0].data = chartData.data;
                        chart.data.datasets[0].backgroundColor = chartData.colors;
                        chart.update();
                    });
                 "
            >
                <canvas x-ref="canvas" wire:ignore></canvas>
            </div>

            <!-- Status counts table -->
            <div class="mt-4">
                <table class="table table-sm">
                    <tbody>
                        @foreach($chartData['labels'] as $index => $status)
                        <tr>
                            <td>
                                <span class="mr-2" style="color: {{ $chartData['colors'][$index] }}">●</span>
                                {{ $status }}
                            </td>
                            <td class="text-right">{{ $chartData['data'][$index] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
