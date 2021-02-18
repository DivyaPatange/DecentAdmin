<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allotment extends Model
{
    use HasFactory;

    protected $table = "allotments";

    protected $fillable = ['class_id', 'academic_id'];

    public function sessions(){
        return $this->belongsTo('App\Models\Admin\AcademicYear','academic_id', 'id');
    }

    public function classes(){
        return $this->belongsTo('App\Models\Admin\Classes','class_id', 'id');
    }
}
