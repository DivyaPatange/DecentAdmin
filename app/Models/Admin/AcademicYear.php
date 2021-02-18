<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $table = "academic_years";

    protected $fillable = ['from_academic_year', 'to_academic_year', 'status'];

    public function junior_admission(){
        return $this->hasMany('App\Models\Admin\JuniorAdmission','academic_id', 'id');
    }

    public function fees(){
        return $this->hasMany('App\Models\Admin\Fee','academic_id', 'id');
    }

    public function allotment(){
        return $this->hasMany('App\Models\Admin\Allotment','academic_id', 'id');
    }
    
}
