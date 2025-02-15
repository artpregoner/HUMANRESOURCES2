<div>
    <div class="card">
        <h5 class="card-header">Select Example</h5>
        <form wire:submit.prevent="submit">
            <div class="card-body">
                <div class="form-group">
                    <label for="currencySelector">
                        Currency *
                        <button class="btn btn-xs btn-outline btn-link" data-toggle="popover"
                            data-content="You must select the currency that you have used.">
                            <i class="fa fa-question-circle"></i>
                        </button>
                    </label>
                    <select wire:model="currency" class="custom-select d-block w-100 col-sm-2" id="currencySelector"
                        required>
                        <option value="PHP">PHP</option>
                        <option value="USD">USD</option>
                    </select>
                    @error('currency')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Expense Date -->
                <div class="form-group">
                    <label for="inputClaimDate">
                        Expense Claim Date *
                        <button class="btn btn-xs m-b-xs btn-outline btn-link"
                            data-content="Please enter the date of your claim expenses here." data-placement="top"
                            data-toggle="popover" tabindex="-1" type="button">
                            <i class="fa fa-question-circle"></i>
                        </button>
                    </label>
                    <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                        <input type="datetime-local" class="form-control col-sm-2 " wire:model="expense_date">
                    </div>
                    @error('expense_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description" class="col-form-label">Description *
                        <button class="btn btn-xs btn-outline btn-link" data-toggle="popover"
                            data-content="Specify an overall reason for this expense claim.">
                            <i class="fa fa-question-circle"></i>
                        </button>
                    </label>
                    <input wire:model="description" type="text" class="form-control" id="description">
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Comments -->
                <div class="form-group">
                    <label for="comments">Comments (Optional)</label>
                    <textarea wire:model="comments" class="form-control" id="comments" rows="3"></textarea>
                    @error('comments')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <!-- Claim Lines Section -->
            <div class="card-body border-top">

                <!-- Mobile Header -->
                <div class="form-row d-md-none claim-header mb-2">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <span>Category</span>
                            <span>Details</span>
                            <span>Amount</span>
                        </div>
                    </div>
                </div>

                <!-- Claim Lines -->
                <div id="claimLines">
                    @foreach ($claim_lines as $index => $line)
                        <div class="form-row claim-line mb-3">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                <select wire:model="claim_lines.{{ $index }}.category"
                                    class="custom-select d-block w-100">
                                    <option value="">Choose...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error("claim_lines.{$index}.category")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                <input wire:model="claim_lines.{{ $index }}.details" type="text"
                                    class="form-control" placeholder="Enter Details">
                                @error("claim_lines.{$index}.details")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-11 col-10">
                                <input wire:model.lazy="claim_lines.{{ $index }}.amount" type="number"
                                    step="0.01" class="form-control" placeholder="Enter Amount">
                                @error("claim_lines.{$index}.amount")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @if (!$line['is_fixed'])
                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-2 d-flex align-items-center">
                                    <button wire:click.prevent="removeClaimLine({{ $index }})"
                                        class="btn btn-link text-danger p-0">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Add Line and Total -->
                <div class="form-row d-flex justify-content-between align-items-center mt-3">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                        @if ($canAddMore)
                            <button wire:click.prevent="addClaimLine" class="btn btn-primary btn-sm">Add A New
                                Line</button>
                        @endif
                    </div>
                    <div class="col-auto d-flex">
                        <label class="mb-0 mr-2 font-weight-bold">Total:</label>
                        <label wire:ignore.self wire:listen="totalUpdated"
                            class="mb-0 font-weight-bold">{{ number_format($total, 2) }} {{ $currency }}</label>
                    </div>
                </div>
            </div>


            <div class="card-body border-top">
                <label for="file-upload" class="btn btn-sm btn-light mr-2">
                    <i class="fas fa-image"></i> Upload Receipts
                </label>
                <small class="text-muted ml-2">Maximum 10 images</small>
                <input wire:model="files" type="file" id="file-upload" class="d-none" multiple accept="image/*" max="10">

                <!--display dont hide then start with 0 to 100-->
                {{-- @if ($uploadProgress > 0) --}}
                    <div class="progress mb-3">
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                            style="width: {{ $uploadProgress }}%">
                        </div>
                    </div>
                {{-- @endif --}}

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        @foreach ($files as $index => $file)
                            <div class="media influencer-profile-data d-flex align-items-center p-2">
                                <div class="mr-4">
                                    <img src="{{ $file->temporaryUrl() }}" alt="User Avatar" class="user-avatar-xl">
                                </div>
                                <div class="media-body ">
                                    <div class="influencer-profile-data">
                                        <h5 class="m-b-10">{{ $file->getClientOriginalName() }}</h5>
                                        <p>
                                            <span class="m-r-20 d-inline-block">
                                                {{ isset($fileSizes[$index]) ? number_format($fileSizes[$index] / 1024, 2) : '0' }} KB
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <button type="button" wire:click="removeFile({{ $index }})"
                                    class="btn btn-sm btn-danger ml-auto">×</button>
                            </div>
                        @endforeach
                    </div>
                    @error('files.*') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Footer Section -->
            <div class="card-body border-top">
                <div class="row">
                    <div class="col-sm-6 d-flex align-items-center">
                        <div class="custom-control custom-checkbox">
                            <input wire:model="reimbursement_required" type="checkbox" class="custom-control-input"
                                id="reimbursement_required">
                            <label class="custom-control-label" for="reimbursement_required">
                                Reimbursement is required for this expense claim
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6 text-right">
                        <button type="submit" class="btn btn-primary btn-space">Submit</button>
                        <a href="{{ route('portal.claims.index') }}" class="btn btn-light btn-space">Cancel</a>
                    </div>
                </div>
            </div>
        </form>

        <!-- Flash Messages -->
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>
