<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = "students";

    protected $fillable = ['admission_id', 'student_name','regi_no', 'class_id', 'section_id', 'academic_id', 'roll_no', 'status', 'is_promoted' ,'old_registration_id', 'created_by'];
}
