{{-- <div class="row">
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header"><i class="fas fa-info"></i> Employee Information</h5>
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Code</th>
                                <td>{{ Auth::user()->employeeDetails->employee_code ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td>{{ Auth::user()->employeeDetails->department->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td>{{ Auth::user()->employeeDetails->work_location}}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ Auth::user()->employeeDetails->employment_status}}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{ Auth::user()->personalInformation->gender}}</td>
                            </tr>
                            <tr>
                                <th>Born</th>
                                <td>{{ Auth::user()->personalInformation->date_of_birth->format('F d, Y')}}</td>
                            </tr>
                            <tr>
                                <th>Age</th>
                                <td>{{ Auth::user()->personalInformation?->date_of_birth ? \Carbon\Carbon::parse($user->personalInformation->date_of_birth)->age : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Joining Date</th>
                                <td>{{ Auth::user()->employeeDetails->joining_date->format('F d, Y') }}</td>
                            </tr>
                            <tr>
                                <th>Employee For</th>
                                <td>{{ Auth::user()->employeeDetails?->joining_date ? \Carbon\Carbon::parse(Auth::user()->employeeDetails->joining_date)->diffForHumans() : 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <!-- ============================================================== -->
    <!-- NO DATA -->
    <!-- ============================================================== -->
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header"><i class="fas fa-info"></i> Employee Information</h5>
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Code</th>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <th>Born</th>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <th>Age</th>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <th>Joining Date</th>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <th>Employee For</th>
                                <td>N/A</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
