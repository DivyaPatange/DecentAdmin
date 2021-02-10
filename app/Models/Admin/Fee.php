<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $table = "fees";

    protected $fillable = ['fee_head_id', 'class_id', 'academic_id', 'amount', 'description', 'status'];

    public function fee_head(){
        return $this->belongsTo('App\Models\Admin\FeeHead','fee_head_id', 'id');
    }

    public function classes(){
        return $this->belongsTo('App\Models\Admin\Classes','class_id', 'id');
    }

    public function sessions(){
        return $this->belongsTo('App\Models\Admin\AcademicYear','academic_id', 'id');
    }
}
