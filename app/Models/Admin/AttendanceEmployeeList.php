<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceEmployeeList extends Model
{
    use HasFactory;

    protected $table = "attendance_employee_lists";

    protected $fillable = ['emp_attendance_id', 'teacher_id', 'status'];
}
