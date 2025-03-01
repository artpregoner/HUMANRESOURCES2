<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="section-block">
            <h3 class="section-title">Claims & Reimbursement Section</h3>
        </div>
    </div>

    <!-- Claims Status Chart -->
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <h5 class="card-header">Claims Status</h5>
            <div class="card-body">
                <canvas id="claims-status-chart" width="220" height="155"></canvas>
            </div>
        </div>
    </div>

    <!-- Claims Data -->
    <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12">
        <div class="row">
            <!-- Claims Count List -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Total Count Claims</h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fa-xs text-light mr-1 legend-title"><i class="fa fa-fw fa-square-full"></i></span> Submitted
                                <span class="badge badge-primary badge-pill">{{ $chartData['data'][0] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fa-xs text-code3 mr-1 legend-title"><i class="fa fa-fw fa-square-full"></i></span> Pending
                                <span class="badge badge-primary badge-pill">{{ $chartData['data'][1] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fa-xs text-success mr-1 legend-title"><i class="fa fa-fw fa-square-full"></i></span> Approved
                                <span class="badge badge-primary badge-pill">{{ $chartData['data'][2] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fa-xs text-danger mr-1 legend-title"><i class="fa fa-fw fa-square-full"></i></span> Rejected
                                <span class="badge badge-primary badge-pill">{{ $chartData['data'][3] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fa-xs text-warning mr-1 legend-title"><i class="fa fa-fw fa-square-full"></i></span> Unapproved
                                <span class="badge badge-primary badge-pill">{{ $chartData['data'][4] }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Total Claims, New Submitted Claims, Paid -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="card border-3 border-top border-top-primary">
                            <div class="card-body text-center">
                                <h5 class="text-muted">Total Claims</h5>
                                <h1 class="mb-1">{{ $totalClaims }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="card border-3 border-top border-top-primary">
                            <div class="card-body text-center">
                                <h5 class="text-muted">New Submitted Claims</h5>
                                <h1 class="mb-1">{{ $newSubmittedClaims }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="card border-3 border-top border-top-primary">
                            <div class="card-body text-center">
                                <h5 class="text-muted">Paid</h5>
                                <h1 class="mb-1">0</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById("claims-status-chart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [{
                backgroundColor: {!! json_encode($chartData['colors']) !!},
                data: {!! json_encode($chartData['data']) !!}
            }]
        },
        options: {
            legend: {
                display: false
            }
        }
    });
});
</script>
@endpush
