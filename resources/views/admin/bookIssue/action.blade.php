<div class="switch_box box_1">
    <input type="checkbox" class="switch_1" data-id="{{ $id }}" @if($status == 1) Checked @endif>
</div>
<a href="{{ route('admin.book-issue.edit', $id) }}"><button class="btn waves-effect btn-sm waves-light btn-warning btn-icon"><i class="icofont icofont-ui-edit mr-0"></i></button></a>
<a href="javascript:void(0)" id="delete" data-id="{{ $id }}"><button class="btn waves-effect btn-sm waves-light btn-danger btn-icon"><i class="icofont icofont-ui-delete mr-0"></i></button></a>