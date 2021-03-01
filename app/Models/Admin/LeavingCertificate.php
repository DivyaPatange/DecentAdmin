<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeavingCertificate extends Model
{
    use HasFactory;

    protected $table = "leaving_certificates";

    protected $fillable = ['allot_student_id', 'admission_id', 'general_reg_no', 'mother_tongue', 'birth_place', 'taluka', 'district', 'state',
    'country', 'academic_progress', 'conduct', 'leaving_date', 'college_studying', 'leaving_reason', 'remarks', 'date_present'];
}
