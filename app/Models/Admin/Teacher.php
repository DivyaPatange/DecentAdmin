<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = "teachers";

    protected $fillable = ['name', 'designation', 'qualification', 'dob', 'gender', 'religion', 'email', 'username', 'password'];

    public function sections(){
        return $this->hasMany('App\Models\Admin\Section','teacher_id', 'id');
    }

    public function subjectTeacher(){
        return $this->hasMany('App\Models\Admin\SubjectTeacher','teacher_id', 'id');
    }
}
