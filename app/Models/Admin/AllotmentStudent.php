<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllotmentStudent extends Model
{
    use HasFactory;

    protected $table = "allotment_students";

    protected $fillable = ['allotment_id', 'collage_ID', 'status'];

    public function admission(){
        return $this->belongsTo('App\Models\Admin\JuniorAdmission','admission_id', 'id');
    }
}
