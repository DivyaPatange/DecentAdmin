<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    use HasFactory;

    protected $table = "subject_teachers";

    protected $fillable = ['section_id', 'class_id', 'teacher_id', 'status'];

    public function subjects(){
        return $this->belongsTo('App\Models\Admin\Subject','subject_id', 'id');
    }

    public function teachers(){
        return $this->belongsTo('App\Models\Admin\Teacher','teacher_id', 'id');
    }
}
