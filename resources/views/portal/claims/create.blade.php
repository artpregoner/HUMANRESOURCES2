@extends('layouts.app')
@section('title', 'Claims&Reimbursement')
@section('header','Claims&Reimbursement') <!--pageheader-->
@section('active-header', 'Request')<!--active pageheader-->

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Claims & Reimbursement Request</h5>
            <div class="card-body">
                <form>

                    <div class="form-group">
                        <form>
                            <div class="form-group">
                                <label for="input-select">Claim Type</label>
                                <select class="form-control" id="input-select">
                                    <option>Travel</option>
                                    <option>Food</option>
                                    <option>Medical</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Claim Amount ($)</label>
                        <input id="inputText3" type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="card-body border-top">
                    <div class="form-group row text-right">
                        <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0 ml-auto">
                            <button type="submit" class="btn btn-space btn-primary">Submit</button>
                            <button class="btn btn-space btn-secondary" onclick="window.location.href='{{ route('portal.claims.index') }}'">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
