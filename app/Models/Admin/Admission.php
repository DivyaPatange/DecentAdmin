<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $table = "admissions";

    protected $fillable = ['parent_id', 'admission_for', 'application_no', 'academic_id', 'admission_date', 'student_name', 'student_photo',
    'father_name', 'mother_name', 'f_occupation', 'm_occupation', 'mobile_no', 'address', 'adhaar_no', 'dob', 'id_no', 'religion', 'caste', 'sub_caste',
    'last_exam_passed', 'percentage', 'math_mark', 'science_mark', 'out_of', 'last_school_attended', 'board', 'adm_sought', 'stream', 'gr_no',
    'full_name_pupil', 'surname', 'postal_address', 'occupation', 'race_caste', 'monthly_income', 'birth_place', 'nationality', 'medium', 'rte', 'father_name1',
    'f_education', 'f_address', 'f_phone_no', 'mother_name1', 'm_education', 'm_address', 'm_phone_no', 'guardian_name', 'g_occupation', 'g_education', 'g_address',
    'g_phone_no', 'other_board', 'is_register', 'is_allot'];

    public function sessions(){
        return $this->belongsTo('App\Models\Admin\AcademicYear','academic_id', 'id');
    }
}
