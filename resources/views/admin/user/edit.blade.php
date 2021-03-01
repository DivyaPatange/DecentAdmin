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
                <h5>Edit User</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form class="form-material" id="form-submit" method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
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
                                <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}">
                                <span class="form-bar"></span>
                                <label class="float-label">Email<span style="color:red;">*</span><span  style="color:red" id="email_err"> </span></label>
                                @error('email')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                            </div>
                        </div>
                        <?php 
                            $role_access = explode(",", $user->role_access);
                        ?>
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
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Add User" @if(in_array("Add User", $role_access)) Checked @endif>Add User
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="User List" @if(in_array("User List", $role_access)) Checked @endif>User List
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Academic Year" @if(in_array("Academic Year", $role_access)) Checked @endif>Academic Year
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Document" @if(in_array("Document", $role_access)) Checked @endif>Document Master
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Standard" @if(in_array("Standard", $role_access)) Checked @endif>Standard
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Section" @if(in_array("Section", $role_access)) Checked @endif>Section
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Class" @if(in_array("Class", $role_access)) Checked @endif>Class
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="New Junior Admission" @if(in_array("New Junior Admission", $role_access)) Checked @endif>New Junior Admission
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Junior Admission List" @if(in_array("Junior Admission List", $role_access)) Checked @endif>Junior Admission List
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="New School Admission" @if(in_array("New School Admission", $role_access)) Checked @endif>New School Admission
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="School Admission List" @if(in_array("School Admission List", $role_access)) Checked @endif>School Admission List
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="New Allotment" @if(in_array("New Allotment", $role_access)) Checked @endif>New Allotment                                      
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Allotment List" @if(in_array("Allotment List", $role_access)) Checked @endif>Allotment List
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Junior College Certificate" @if(in_array("Junior College Certificate", $role_access)) Checked @endif>Junior College Certificate
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Primary School Certificate" @if(in_array("Primary School Certificate", $role_access)) Checked @endif>Primary School Certificate
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Fee Head" @if(in_array("Fee Head", $role_access)) Checked @endif>Fee Head
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Add Fee" @if(in_array("Add Fee", $role_access)) Checked @endif>Add Fee
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Pay Fee" @if(in_array("Pay Fee", $role_access)) Checked @endif >Pay Fee
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Visitor Registration" @if(in_array("Visitor Registration", $role_access)) Checked @endif>Visitor Registration
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Inward Document" @if(in_array("Inward Document", $role_access)) Checked @endif>Inward Document
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="role_access[]" class="form-check-input" value="Outward Document" @if(in_array("Outward Document", $role_access)) Checked @endif>Outward Document
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <button class="btn btn-sm waves-effect waves-light hor-grd btn-grd-primary" type="submit" id="submitForm">Update</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

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