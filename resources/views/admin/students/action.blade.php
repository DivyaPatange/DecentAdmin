<a href="{{ route('admin.students.show', $id) }}"><button class="btn waves-effect waves-light btn-info btn-icon"><i class="icofont icofont-eye-alt mr-0"></i></button></a>
<a href="{{ route('admin.students.edit', $id) }}"><button class="btn waves-effect btn-sm waves-light btn-warning btn-icon"><i class="icofont icofont-ui-edit mr-0"></i></button></a>
<a href="javascript:void(0)" id="delete" data-id="{{ $id }}"><button class="btn waves-effect btn-sm waves-light btn-danger btn-icon"><i class="icofont icofont-ui-delete mr-0"></i></button></a>