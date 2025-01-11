@extends('layouts.app')
@section('title', 'Claims')
@section('header', 'Claims')
@section('active-header', 'Request Expenses')

@push('styles')
<style>
    @media (max-width: 767px) {
        .claim-header {
            background-color: #f8f9fa;
            padding: 10px;
            margin-bottom: 15px;
            font-weight: bold;
            border-bottom: 2px solid #dee2e6;
        }

        .claim-header span {
            font-size: 0.9rem;
        }

        .claim-line {
            background-color: #fff;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .claim-line > div {
            margin-bottom: 10px;
        }

        /* Hide desktop labels on mobile */
        .d-none.d-md-block {
            display: none !important;
        }

        .delete-line {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    }

    .delete-line {
        font-size: 1.1rem;
    }

    .delete-line:hover {
        color: #dc3545 !important;
    }
    </style>
@endpush

@section('content')
<div class="row">
    <!-- ============================================================== -->
    <!-- basic form -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Claims Request</h5>
            <div class="card-body">
                <form action="#" id="basicform" data-parsley-validate="">
                    <div class="form-group col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                        <label for="inputClaimTo">Send Claim To *</label>
                        <input id="inputClaimTo" type="text" name="name" data-parsley-trigger="change" required="" placeholder="Enter user name" autocomplete="off" class="form-control">
                    </div>
                    <div class="form-group col-sm-3 pb-2 pb-sm-4 pb-lg-0 pr-0">
                        <label for="inputClaimDate">Expense Claim Date *</label>
                        <input id="inputClaimDate" type="date" name="date" data-parsley-trigger="change" required="" autocomplete="off" class="form-control">
                    </div>
                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="inputDescription" class="col-form-label">Description *</label>
                        <input id="inputDescription" type="text" class="form-control" placeholder="Specify an overall reason for this expense claim. You can expand on this further down the page.">
                    </div>
                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="inputComments">Comments (Optional)</label>
                        <textarea class="form-control" id="inputComments" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <!-- claims details, category, amount -->
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

                    <div id="claimLines">
                        <div class="form-row claim-line">
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
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="claimsDetails" class="d-none d-md-block">Details</label>
                                <input type="text" class="form-control" name="claims[0][details]" placeholder="Enter Details" required>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="claimsAmount" class="d-none d-md-block">Amount *</label>
                                <input type="number" class="form-control amount-input" name="claims[0][amount]" placeholder="Enter Amount" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <a href="#" class="btn btn-primary btn-sm" id="addNewLine">Add A New Line</a>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <label>Total</label>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <label id="totalAmount">0</label>
                        </div>
                    </div>

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
                                    <button type="submit" class="btn btn-space btn-success">Submit</button>
                                    <button type="button" class="btn btn-space btn-light">Cancel</button>
                                </p>
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
</script>
@endpush
