@push('styles')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
@endpush
<div class="row">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-muted">Total Employees</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">{{ $totalUsers }}</h1>
                </div>
                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                    <span><i class="fa fa-fw fa-arrow-up"></i></span><span>2.63%</span>
                </div>
            </div>
            <div id="sparkline-employees"></div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-muted">Active Jobs</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">4</h1>
                </div>
                <div class="metric-label d-inline-block float-right text-primary font-weight-bold">
                    <span><i class="fa fa-fw fa-arrow-down"></i></span><span>1.08%</span>
                </div>
            </div>
            <div id="sparkline-jobs"></div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-muted">Applications</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">4</h1>
                </div>
                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                    <span><i class="fa fa-fw fa-arrow-up"></i></span><span>3.55%</span>
                </div>
            </div>
            <div id="sparkline-applications"></div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-muted">Turnover</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">4</h1>
                </div>
                <div class="metric-label d-inline-block float-right text-danger font-weight-bold">
                    <span><i class="fa fa-fw fa-arrow-up"></i></span><span>2.00%</span>
                </div>
            </div>
            <div id="sparkline-turnover"></div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        /* Sparkline Employees */
        if($("#sparkline-employees").length) {
            $("#sparkline-employees").sparkline([140, 142, 145, 148, 150, 152, 153, 155, 156, 156, 156, 156], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#5969ff',
                fillColor: 'rgba(89, 105, 255, 0.2)',
                highlightLineColor: 'rgba(89, 105, 255, 0.1)',
                highlightSpotColor: 'rgba(89, 105, 255, 0.1)'
            });
        }

        /* Sparkline Jobs */
        if($("#sparkline-jobs").length) {
            $("#sparkline-jobs").sparkline([4, 4, 3, 3, 5, 5, 4, 4, 3, 3, 3, 3], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ff407b',
                fillColor: 'rgba(255, 64, 123, 0.2)',
                highlightLineColor: 'rgba(255, 64, 123, 0.1)',
                highlightSpotColor: 'rgba(255, 64, 123, 0.1)'
            });
        }

        /* Sparkline Applications */
        if($("#sparkline-applications").length) {
            $("#sparkline-applications").sparkline([20, 28, 32, 35, 40, 45, 48, 50, 46, 48, 48, 48], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#25d5f2',
                fillColor: 'rgba(37, 213, 242, 0.2)',
                highlightLineColor: 'rgba(37, 213, 242, 0.1)',
                highlightSpotColor: 'rgba(37, 213, 242, 0.1)'
            });
        }

        /* Sparkline Turnover */
        if($("#sparkline-turnover").length) {
            $("#sparkline-turnover").sparkline([2, 1, 2, 0, 1, 2, 3, 2, 4, 3, 4, 4], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffc750',
                fillColor: 'rgba(255, 199, 80, 0.2)',
                highlightLineColor: 'rgba(255, 199, 80, 0.1)',
                highlightSpotColor: 'rgba(255, 199, 80, 0.1)'
            });
        }
    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
@endpush
