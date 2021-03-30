<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use HasFactory;

    protected $table = "employee_attendances";

    protected $fillable = ['attendance_date', 'created_by', 'created_by_id'];
}
