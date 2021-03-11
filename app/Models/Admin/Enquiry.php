<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $table = "enquiries";

    protected $fillable = ['enquiry_no', 'student_name', 'father_name', 'student_name', 'dob', 'contact_no', 'address', 'last_exam_passed', 'percentage', 'adm_sought', 'is_register'];
}
