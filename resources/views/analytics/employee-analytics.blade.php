@push('styles')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
@endpush

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
    <!-- Total Employees -->
    <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h5 class="text-gray-500 dark:text-gray-400">Total Employees</h5>
        <div class="flex items-center justify-between mt-2">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalUsers }}</h1>
            <div class="flex items-center gap-1 font-semibold text-green-500 dark:text-green-400">
                <i class="fa fa-arrow-up"></i>
                <span>2.63%</span>
            </div>
        </div>
        <div id="sparkline-employees" class="mt-2"></div>
    </div>

    <!-- Active Jobs -->
    <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h5 class="text-gray-500 dark:text-gray-400">Active Jobs</h5>
        <div class="flex items-center justify-between mt-2">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">4</h1>
            <div class="flex items-center gap-1 font-semibold text-blue-500 dark:text-blue-400">
                <i class="fa fa-arrow-down"></i>
                <span>1.08%</span>
            </div>
        </div>
        <div id="sparkline-jobs" class="mt-2"></div>
    </div>

    <!-- Applications -->
    <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h5 class="text-gray-500 dark:text-gray-400">Applications</h5>
        <div class="flex items-center justify-between mt-2">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">4</h1>
            <div class="flex items-center gap-1 font-semibold text-green-500 dark:text-green-400">
                <i class="fa fa-arrow-up"></i>
                <span>3.55%</span>
            </div>
        </div>
        <div id="sparkline-applications" class="mt-2"></div>
    </div>

    <!-- Turnover -->
    <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h5 class="text-gray-500 dark:text-gray-400">Turnover</h5>
        <div class="flex items-center justify-between mt-2">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">4</h1>
            <div class="flex items-center gap-1 font-semibold text-red-500 dark:text-red-400">
                <i class="fa fa-arrow-up"></i>
                <span>2.00%</span>
            </div>
        </div>
        <div id="sparkline-turnover" class="mt-2"></div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sparkOptions = (lineColor, fillColor) => ({
            type: 'line',
            width: '100%',
            height: '50',
            lineColor: lineColor,
            fillColor: fillColor,
            highlightLineColor: fillColor.replace('0.2', '0.1'),
            highlightSpotColor: fillColor.replace('0.2', '0.1'),
        });

        $("#sparkline-employees").sparkline([140, 142, 145, 148, 150, 152, 153, 155, 156, 156, 156, 156],
            sparkOptions('#5969ff', 'rgba(89, 105, 255, 0.2)'));

        $("#sparkline-jobs").sparkline([4, 4, 3, 3, 5, 5, 4, 4, 3, 3, 3, 3],
            sparkOptions('#ff407b', 'rgba(255, 64, 123, 0.2)'));

        $("#sparkline-applications").sparkline([20, 28, 32, 35, 40, 45, 48, 50, 46, 48, 48, 48],
            sparkOptions('#25d5f2', 'rgba(37, 213, 242, 0.2)'));

        $("#sparkline-turnover").sparkline([2, 1, 2, 0, 1, 2, 3, 2, 4, 3, 4, 4],
            sparkOptions('#ffc750', 'rgba(255, 199, 80, 0.2)'));
    });
</script>
@endpush
