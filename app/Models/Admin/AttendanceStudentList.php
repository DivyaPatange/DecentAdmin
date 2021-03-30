<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceStudentList extends Model
{
    use HasFactory;

    protected $table = "attendance_student_lists";

    protected $fillable = ['stud_attendance_id', 'student_id'];
}
