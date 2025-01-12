@extends('layouts.app')
@section('title', 'Claims')
@section('header', 'Claims')
@section('active-header', 'Request Expenses')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/summernote/css/summernote-bs4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/select2/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/datepicker/tempusdominus-bootstrap-4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/bootstrap-select/css/bootstrap-select.css') }}">
@endpush

@section('content')
<div class="row">
    <!-- ============================================================== -->
    <!-- Claims -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Claims Request</h5>
            <div class="card-body">
                <!-- Form for basic claim request details -->
                <form action="#" id="basicform" data-parsley-validate="">
                    <!-- Select recipient of the claim -->
                    <div class="form-group col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                        <label for="inputClaimTo">Send Claim To *</label>
                        <div class="form-group row pt-0">
                            <div class="col-md-11">
                                <select class="selectpicker" multiple data-style="btn-outline-code3">
                                    <option value="admin" selected>Admin</option>
                                    <option value="HR">HR</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Expense claim date input -->
                    <div class="form-group col-sm-3 pb-2 pb-sm-4 pb-lg-0 pr-0">
                        <label for="inputClaimDate">Expense Claim Date *</label>
                        <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" />
                            <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>

                    <!-- Description of the claim -->
                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="inputDescription" class="col-form-label">Description *<button class="btn btn-xs m-b-xs btn-outline btn-link" data-content="Specify an overall reason for this expense claim." data-placement="top" data-toggle="popover" tabindex="-1" type="button" data-original-title="" title="">
                            <i class="fa fa-question-circle"></i>
                            </button></label>
                        <input id="inputDescription" type="text" class="form-control" placeholder="">
                    </div>

                    <!-- Optional comments field -->
                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="inputComments">Comments (Optional)</label>
                        <textarea class="form-control" id="inputComments" rows="3"></textarea>
                    </div>
                </form>
            </div>

            <!-- Section for adding claims details, category, and amount -->
            <div class="card-body border-top">
                <form class="needs-validation"novalidate>
                    <!-- Header for mobile -->
                    <div class="form-row d-md-none claim-header">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span>Category</span>
                                <span>Details</span>
                                <span>Amount</span>
                            </div>
                        </div>
                    </div>

                    <!-- Initial claim line row -->
                    <div id="claimLines">
                        <div class="form-row claim-line">
                            <!-- Category dropdown -->
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="claimsCategory" class="d-none d-md-block">Category *</label>
                                <select class="custom-select d-block w-100" name="claims[0][category]" required>
                                    <option value="">Choose...</option>
                                    <option value="Fuel">Fuel</option>
                                    <option value="Medical">Medical</option>
                                    <option value="Fare">Fare</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid Category.
                                </div>
                            </div>

                            <!-- Details input field -->
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="claimsDetails" class="d-none d-md-block">Details<button class="btn btn-xs m-b-xs btn-outline btn-link" data-content="Details for this expense." data-placement="top" data-toggle="popover" tabindex="-1" type="button" data-original-title="" title="">
                                    <i class="fa fa-question-circle"></i>
                                    </button></label>
                                <input type="text" class="form-control" name="claims[0][details]" placeholder="Enter Details" required>
                            </div>

                            <!-- Amount input field -->
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="claimsAmount" class="d-none d-md-block">Amount *<button class="btn btn-xs m-b-xs btn-outline btn-link" data-content="Philippine peso" data-placement="top" data-toggle="popover" tabindex="-1" type="button" data-original-title="" title="">
                                    <i class="fa fa-question-circle"></i>
                                    </button></label>
                                <input type="number" class="form-control amount-input" name="claims[0][amount]" placeholder="Enter Amount" required>
                            </div>
                        </div>
                    </div>

                    <!-- Section to add a new claim line and display total amount -->
                    <div class="form-row">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <a href="#" class="btn btn-code3 btn-sm" id="addNewLine">Add A New Line</a>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <label>Total</label>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <label id="totalAmount">0</label>
                        </div>
                    </div>

                    <!-- Footer section with checkboxes and submit/cancel buttons -->
                    <div class="card-body border-top">
                        <div class="row">
                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                <label class="be-checkbox custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="reimbursement_required">
                                    <span class="custom-control-label">Reimbursement is required for this expense claim</span>
                                </label>
                            </div>
                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-code3">Submit</button>
                                    <button type="button" class="btn btn-space btn-light" onclick="window.location.href='{{ route('portal.claims.index')}}'">Cancel</button>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- File upload section for receipts -->
                    <div class="card-body border-top">
                        <div class="row">
                            <div class="upload-container">
                                <p>Upload Receipts</p>
                                <div class="drop-area" id="drop-area">
                                    Drop files (or click/tap) here to upload.
                                </div>
                                <input type="file" id="file-input" class="file-input" multiple accept="image/*" />
                                <label for="file-input" class="file-input-label">Choose Files</label>

                                <div class="file-info" id="file-info">
                                    <p>File size limit: <span>200MB</span></p>
                                </div>

                                <div class="image-preview" id="image-preview">
                                    <!-- Images will be previewed here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let lineCount = 0;
        const claimLines = document.getElementById('claimLines');
        const addNewLine = document.getElementById('addNewLine');
        const totalAmountLabel = document.getElementById('totalAmount');

        function updateTotal() {
            const amounts = document.querySelectorAll('.amount-input');
            let total = 0;
            amounts.forEach(input => {
                total += parseFloat(input.value) || 0;
            });
            totalAmountLabel.textContent = total.toFixed(2);
        }

        function deleteLine(e) {
            e.preventDefault();
            const line = e.target.closest('.claim-line');
            if (line) {
                line.remove();
                updateTotal();
            }
        }

        addNewLine.addEventListener('click', function(e) {
            e.preventDefault();
            lineCount++;

            const newLine = document.createElement('div');
            newLine.className = 'form-row claim-line';
            newLine.innerHTML = `
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                    <select class="custom-select d-block w-100" name="claims[${lineCount}][category]" required>
                        <option value="">Choose...</option>
                        <option value="Fuel">Fuel</option>
                        <option value="Medical">Medical</option>
                        <option value="Fare">Fare</option>
                    </select>
                    <div class="invalid-feedback">
                        Please provide a valid Category.
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                    <input type="text" class="form-control" name="claims[${lineCount}][details]" placeholder="Enter Details" required>
                </div>
                <div class="col-xl-3.5 col-lg-3 col-md-11 col-sm-11 col-11 mb-2">
                    <input type="number" class="form-control amount-input" name="claims[${lineCount}][amount]" placeholder="Enter Amount" required>
                </div>
                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1 mb-2 d-flex align-items-center">
                    <a href="#" class="delete-line text-danger">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>
            `;

            claimLines.appendChild(newLine);

            // Add event listener to new amount input
            const newAmountInput = newLine.querySelector('.amount-input');
            newAmountInput.addEventListener('input', updateTotal);

            // Add event listener to delete button
            const deleteButton = newLine.querySelector('.delete-line');
            deleteButton.addEventListener('click', deleteLine);
        });

        // Add event listeners to initial amount inputs
        document.querySelectorAll('.amount-input').forEach(input => {
            input.addEventListener('input', updateTotal);
        });
    });
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({ tags: true });
    });

    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300

        });
    });
</script>
<script>
    const fileInput = document.getElementById('file-input');
    const imagePreview = document.getElementById('image-preview');

    fileInput.addEventListener('change', (event) => {
        const files = event.target.files;
        imagePreview.innerHTML = ''; // Clear existing previews

        Array.from(files).forEach((file) => {
            // Check if the file is of type jpeg, png, or webp
            if (
                file.type === 'image/jpeg' ||
                file.type === 'image/png' ||
                file.type === 'image/webp'
            ) {
                const reader = new FileReader();

                reader.onload = (e) => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100px'; // Optional: Adjust preview size
                    img.style.margin = '5px'; // Optional: Add spacing between images
                    imagePreview.appendChild(img);
                };

                reader.readAsDataURL(file);
            } else {
                // Alert if the file format is not supported
                alert('Only JPEG, PNG, and WEBP formats are allowed.');
            }
        });
    });
</script>
    <script src="{{ asset('template/assets/vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/summernote/js/summernote-bs4.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/datepicker/moment.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/datepicker/tempusdominus-bootstrap-4.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/datepicker/datepicker.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/bootstrap-select/js/bootstrap-select.js') }}"></script>
@endpush
