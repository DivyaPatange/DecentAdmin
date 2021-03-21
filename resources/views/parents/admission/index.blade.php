@extends('parents.parent_layout.main')
@section('title', 'Admission List')
@section('page_title', 'Admission List')
@section('customcss')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/buttons.bootstrap4.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/select.bootstrap4.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/fixedHeader.bootstrap4.css') }}">
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
		<div class="alert alert-success alert-block mt-3">
			<button type="button" class="close" data-dismiss="alert">×</button>	
				<strong>{{ $message }}</strong>
		</div>
		@endif
		@if ($message = Session::get('danger'))
		<div class="alert alert-danger alert-block mt-3">
			<button type="button" class="close" data-dismiss="alert">×</button>	
				<strong>{{ $message }}</strong>
		</div>
		@endif
    </div>
</div>
<div class="row">
    <!-- ============================================================== -->
    <!-- data table  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Admission List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                        <thead>
                            <tr>
                                <th>Application No.</th>
                                <th>Name</th>
                                <th>Academic Year</th>
                                <th>Admission Date</th>
                                <th>Class</th>
                                <th>Mobile No.</th>
                                <th>Admission Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admission as $a)
                            <tr>

                                <td>{{ $a->application_no }}</td>
                                <td>@if($a->admission_for == "Junior College Admission") {{ $a->student_name }} @else {{ $a->full_name_pupil }} @endif</td>
                                <td>
                                    <?php 
                                        $academicYear = DB::table('academic_years')->where('id', $a->academic_id)->first();
                                    ?>
                                    @if(!empty($academicYear)) ({{ $academicYear->from_academic_year }}) - ({{ $academicYear->to_academic_year }}) @endif
                                </td>
                                <td>{{ $a->admission_date }}</td>
                                <td>
                                    <?php 
                                        $class = DB::table('classes')->where('id', $a->adm_sought)->first();
                                    ?>
                                    @if(!empty($class)) {{ $class->class_name }} @endif
                                </td>
                                <td>{{ $a->mobile_no }}</td>
                                <td>@if($a->is_register == 0) Not Confirmed @else Confirmed @endif</td>
                                <td><a href="{{ route('parent.admission.show', $a->id) }}" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('parent.admission.edit', $a->id) }}" class="btn btn-warning btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                                <form action="{{ route('parent.admission.destroy', $a->id) }}" method="post">
                                    @method('DELETE')
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Application No.</th>
                                <th>Name</th>
                                <th>Academic Year</th>
                                <th>Admission Date</th>
                                <th>Class</th>
                                <th>Mobile No.</th>
                                <th>Admission Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end data table  -->
    <!-- ============================================================== -->
</div>
@endsection
@section('customjs')
<script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="http://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('assets/vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="http://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="http://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="http://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="http://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
<script src="http://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script src="http://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script>


</script>
@endsection
