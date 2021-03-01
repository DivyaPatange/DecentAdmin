<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimarySchool extends Model
{
    use HasFactory;

    protected $table = "primary_schools";

    public function sessions(){
        return $this->belongsTo('App\Models\Admin\AcademicYear','academic_id', 'id');
    }
}
