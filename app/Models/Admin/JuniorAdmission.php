<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuniorAdmission extends Model
{
    use HasFactory;

    protected $table = "junior_admissions";

    protected $fillable = ['admission_reg_no', 'academic_id','admission_date', 'student_photo', 'student_name', 'father_name', 'mother_name',
    'f_occupation', 'm_occupation', 'mobile_no', 'adhaar_no', 'date_of_birth', 'id_no', 'address', 'religion', 'caste', 'sub_caste','last_exam_passed', 'percentage', 'math_mark', 'science_mark', 'out_of',
    'last_school_attended', 'board', 'adm_sought', 'stream', 'other_board','status'];

    public function sessions(){
        return $this->belongsTo('App\Models\Admin\AcademicYear','academic_id', 'id');
    }
}
