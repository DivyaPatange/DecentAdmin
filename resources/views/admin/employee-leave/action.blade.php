@if($status == "Pending")<button id="confirm" data-id="{{ $id }}" class="btn btn-mat waves-effect waves-light btn-success btn-sm"><i class="fa fa-check mr-0"></i></button>
<button id="reject" data-id="{{ $id }}" class="btn btn-mat waves-effect waves-light btn-danger btn-sm"><i class="fa fa-times mr-0"></i></button>
<a href="{{ route('admin.employee-leave.edit', $id) }}"><button class="btn btn-mat waves-effect waves-light btn-primary btn-sm"><i class="icofont icofont-ui-edit mr-0"></i></button></a>
@endif
<button class="btn btn-mat waves-effect waves-light btn-danger btn-sm" id="delete" data-id="{{ $id }}"><i class="icofont icofont-ui-delete mr-0"></i></button>
                                