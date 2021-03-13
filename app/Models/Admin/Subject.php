<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = "subjects";

    protected $fillable = ['subject_name', 'class_id', 'status'];

    public function classes(){
        return $this->belongsTo('App\Models\Admin\Classes','class_id', 'id');
    }

    public function subjectTeacher(){
        return $this->hasMany('App\Models\Admin\SubjectTeacher','subject_id', 'id');
    }
}
