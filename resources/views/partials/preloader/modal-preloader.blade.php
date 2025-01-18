<div id="{{ $id ?? 'modalPreloader' }}" class="preloader-overlay {{ $class ?? 'd-none' }}">
    <span class="dashboard-spinner spinner-success spinner-xl "></span>
    <p>{{ $text ?? 'Loading, please wait...' }}</p>
</div>

{{-- @push('scripts')
<script>
    // Event listener kapag binuksan ang modal
    $(document).ready(function () {
        $('#showClaims').on('show.bs.modal', function () {
            showPreloader('customPreloaderId'); // Ipakita ang preloader kapag binuksan ang modal
            setTimeout(() => hidePreloader('customPreloaderId'), 3000); // Itago ang preloader pagkatapos ng 3 segundo
        });
    });
</script>
@endpush --}}

{{-- para magamit kahit saang modal --}}
{{-- @include('partials.preloader.modal-preloader', ['id' => 'customPreloaderId', 'text' => 'Loading data...']) --}}
