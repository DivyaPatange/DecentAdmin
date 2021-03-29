<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;

    protected $table = "employee_leaves";

    protected $fillable = ['teacher_id', 'leave_type', 'leave_start_date', 'leave_end_date', 'leave_days', 'description', 'status'];
}
