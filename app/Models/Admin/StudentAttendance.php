<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $table = "student_attendances"; 

    protected $fillable = ['class_id', 'student_id', 'attendance_date', 'created_by', 'created_by_id'];
}
