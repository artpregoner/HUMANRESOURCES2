<div class="row">
    <!-- ============================================================== -->
    <!-- Modal -->
    <!-- ============================================================== -->
    <div class="modal fade" id="showClaims" tabindex="-1" role="dialog" aria-labelledby="showClaimsLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header p-2">
                        <div class="float-left">
                            <div class="email-title"><span class="icon"><i class="fas fa-hand-holding-usd"></i></span> Expense Claim</div>
                        </div>
                        <div class="float-right">
                            <h3 class="mb-0"><span class="badge badge-success">Approve</span></h3>
                            <span>by: cute</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="card-body">
                                <form action="#" id="basicform" data-parsley-validate="">
                                    <div class="form-group col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                        <label for="inputClaimTo">Send Claim To</label>
                                        {{-- <input id="inputClaimTo" type="text" name="name" data-parsley-trigger="change" required="" placeholder="Enter user name" autocomplete="off" class="form-control"> --}}
                                        <div class="alert alert-secondary" role="alert">
                                            Admin, HR
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-2 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                        <label for="inputClaimDate">Expense Claim Date</label>
                                        <div class="alert alert-secondary" role="alert">
                                            06/29/2023
                                        </div>
                                    </div>
                                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <label for="inputDescription" class="col-form-label">Description</label>
                                        <div class="alert alert-secondary" role="alert">
                                            This is a secondary alert—check it out!
                                        </div>
                                    </div>
                                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <label for="inputComments">Comments (Optional)</label>
                                        <div class="alert alert-secondary" role="alert">
                                            Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">ID</th>
                                        <th>Category</th>
                                        <th>Details</th>
                                        <th class="right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="center">1</td>
                                        <td class="left strong">Origin License</td>
                                        <td class="left">Extended License</td>
                                        <td class="right">$1,500.00</td>
                                    </tr>
                                    <tr>
                                        <td class="center">2</td>
                                        <td class="left">Custom Services</td>
                                        <td class="left">Installation and Customization (cost per hour)</td>
                                        <td class="right">$110.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-striped">
                                    <tbody>
                                            <td class="center">
                                                <strong class="text-dark">Total</strong>
                                            </td>
                                            <td class="right">
                                                <strong class="text-dark">$7,928.12</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <a href="#" class="btn btn-primary">Download</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Modal -->
    <!-- ============================================================== -->
</div>

