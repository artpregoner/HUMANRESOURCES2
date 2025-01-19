<!-- Modal -->
<div class="modal fade" id="showClaims" tabindex="-1" role="dialog" aria-labelledby="showClaimsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Preloader -->
            @include('partials.preloader.modal-preloader', ['id' => 'showClaimsPreloader', 'text' => 'Loading expenses data...'])
            <!-- Header -->
            <div class="card-header p-2">
                <div class="float-left">
                    <div class="email-title">
                        <span class="icon"><i class="fas fa-hand-holding-usd"></i></span> Expense Claim
                    </div>
                </div>
                <div class="float-right">
                    <h3 class="mb-0"><span class="badge badge-success">Approve</span></h3>
                    {{-- <h3 class="mb-0">
                                @if ($request->status == 'Approved')
                                    <span class="badge badge-success">Approve</span>
                                @elseif ($request->status == 'Pending')
                                    <span class="badge badge-info">Pending</span>
                                @elseif ($request->status == 'Rejected')
                                    <span class="badge badge-danger">Reject</span>
                                @endif
                            </h3> --}}
                    <span>by: cute</span>
                </div>
            </div>
            <!-- Body -->
            <div class="card-body">
                <!-- Form for basic claim request details -->
                <form action="#" id="basicform" data-parsley-validate="">
                    <!-- Select recipient of the claim -->
                    <div class="row">
                        <div class="form-group col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                            <label for="inputClaimTo">Send Claim To *</label>
                            <div class="form-group row pt-0">
                                <div class="col-md-11">
                                    <select class="selectpicker" multiple data-style="btn-outline-code3" disabled>
                                        <option value="admin" selected>Admin</option>
                                        <option value="HR">HR</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Expense claim date input -->
                    <div class="row">
                        <div class="form-group col-sm-3 pb-2 pb-sm-4 pb-lg-0 pr-0">
                            <label for="inputClaimDate">Expense Claim Date *</label>
                            <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input"
                                    data-target="#datetimepicker7" disabled />
                                <div class="input-group-append" data-target="#datetimepicker7"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description of the claim -->
                    <div class="row">
                        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <label for="inputDescription" class="col-form-label">Description *<button
                                    class="btn btn-xs m-b-xs btn-outline btn-link"
                                    data-content="Specify an overall reason for this expense claim."
                                    data-placement="top" data-toggle="popover" tabindex="-1" type="button"
                                    data-original-title="" title="">
                                    <i class="fa fa-question-circle"></i>
                                </button></label>
                            <input id="inputDescription" type="text" class="form-control" placeholder="" disabled>
                        </div>
                    </div>

                    <!-- Optional comments field -->
                    <div class="row">
                        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <label for="inputComments">Comments (Optional)</label>
                            <textarea class="form-control" id="inputComments" rows="3" disabled></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body border-top">
                <!-- Expense Table -->
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Details</th>
                                <th class="right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="left strong">Origin License</td>
                                <td class="left">Extended License</td>
                                <td class="right">0</td>
                            </tr>
                            <tr>
                                <td class="left">Custom Services</td>
                                <td class="left">Installation and Customization (cost per hour)</td>
                                <td class="right">0</td>
                            </tr>
                            <tr> <!--Total Row-->
                                <td></td>
                                <td><strong class="text-dark">Total</strong></td>
                                <td><strong class="text-dark">0</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <!-- Checkbox for reimbursement -->
                    <div class="col-sm-6 d-flex align-items-center">
                        <label class="custom-control custom-checkbox mb-0">
                            <input type="checkbox" class="custom-control-input" name="reimbursement_required" checked disabled>
                            <span class="custom-control-label">Reimbursement is required for this expense
                                claim</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="card-body border-top">
                <div class="row">
                    <div class="media media-attachment">
                        <div class="avatar bg-primary">
                            <i class="far fa-file-image"></i>
                        </div>
                        <div class="media-body">
                            <a href="#" class="">receipt.png</a>
                            <span>24kb Document</span>
                        </div>
                    </div>
                    <div class="media media-attachment">
                        <div class="avatar bg-primary">
                            <i class="far fa-file-image"></i>
                        </div>
                        <div class="media-body">
                            <a href="#" class="">receipt.png</a>
                            <span>24kb Document</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                <a href="#" class="btn btn-primary">Download</a>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
$(document).ready(function () {
    // Dynamic event listener for all modals
    $('[data-toggle="modal"]').on('click', function () {
        var modalId = $(this).data('target').substring(1); // Get the modal id (remove the '#')
        var preloaderId = modalId + 'Preloader'; // Generate unique ID for the preloader

        // Show the preloader when the modal is about to open
        showPreloader(preloaderId);

        // Hide the preloader after 3 seconds (can be adjusted)
        setTimeout(() => hidePreloader(preloaderId), 3000);
    });
});
</script>
@endpush
