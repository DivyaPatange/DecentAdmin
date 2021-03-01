@extends('admin.admin_layout.main')
@section('title', 'User')
@section('page_title', 'User')
@section('breadcrumb', 'User')
@section('customcss')

<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
<!-- animation nifty modal window effects css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/component.css') }}">
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Add User</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form class="form-material" id="form-submit" method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <input type="text" name="name" class="form-control" id="name">
                                <span class="form-bar"></span>
                                <label class="float-label">Name<span style="color:red;">*</span><span  style="color:red" id="name_err"> </span></label>
                                @error('name')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <input type="email" name="email" class="form-control" id="email">
                                <span class="form-bar"></span>
                                <label class="float-label">Email<span style="color:red;">*</span><span  style="color:red" id="email_err"> </span></label>
                                @error('email')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <input type="password" name="password" class="form-control" id="password">
                                <span class="form-bar"></span>
                                <label class="float-label">Password<span style="color:red;">*</span><span  style="color:red" id="status_err"> </span></label>
                                @error('password')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                                <span class="form-bar"></span>
                                <label class="float-label">Confirm Password<span style="color:red;">*</span><span  style="color:red" id="status_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="role_access">Access Role</label><br>
                                        @error('role_access')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Add User">Add User
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="User List">User List
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Category">Academic Year
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Sub-Category">Standard
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Suggestion">Section
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="State">Class
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="New Junior Admission">New Junior Admission
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Junior Admission List">Junior Admission List
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="New School Admission">New School Admission
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="School Admission List">School Admission List
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="New Allotment">New Allotment                                      
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Allotment List">Allotment List
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Junior College Certificate">Junior College Certificate
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Primary School Certificate">Primary School Certificate
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Fee Head">Fee Head
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Add Fee">Add Fee
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Pay Fee">Pay Fee
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Visitor Registration">Visitor Registration
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Inward Document">Inward Document
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Outward Document">Outward Document
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <button class="btn btn-sm waves-effect waves-light hor-grd btn-grd-primary" type="submit" id="submitForm">Submit</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header">
                <h5>Academic Year List</h5>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>From Academic Year</th>
                                <th>To Academic Year</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sr. No.</th>
                                <th>From Academic Year</th>
                                <th>To Academic Year</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- Zero config.table end -->
    </div>
</div>

<!-- Modal -->
<div class="md-modal md-effect-8" id="modal-8">
    <div class="md-content">
        <h3>Edit Academic Year</h3>
        <div>
            <form method="POST" id="editForm">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-default">
                            <input type="month" name="from_academic_year" class="form-control" id="edit_from_academic_year" value="">
                            <span class="form-bar"></span>
                            <label class="float-label">From Academic Year<span style="color:red;">*</span><span  style="color:red" id="edit_from_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-default">
                            <input type="month" name="to_academic_year" class="form-control" id="edit_to_academic_year">
                            <span class="form-bar"></span>
                            <label class="float-label">To Academic Year<span style="color:red;">*</span><span  style="color:red" id="edit_to_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-default">
                            <select name="status" class="form-control" id="edit_status">
                                <option value="">-Select Status-</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label">Status<span style="color:red;">*</span><span  style="color:red" id="edit_status_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" name="id" id="id" value="">
                        <button class="btn btn-sm waves-effect waves-light hor-grd btn-grd-primary" type="button" id="editButton" onclick="return checkSubmit()">Update</button>
                        <button type="button" class="btn btn-sm waves-effect waves-light hor-grd btn-grd-danger md-close">Close</button>
                    </div>
                </div>
            </form>
            
            
        </div>
    </div>
</div>
<div class="md-overlay"></div>
@endsection
@section('customjs')

<!-- data-table js -->
<script src="{{ asset('files/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/jszip.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Custom js -->
<script src="{{ asset('files/assets/pages/data-table/js/data-table-custom.js') }}"></script>


<script>


</script>

@endsection