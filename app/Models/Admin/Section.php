<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = "sections";

    protected $fillable = ['section_name', 'capacity', 'class_id', 'teacher_id', 'note', 'status'];
    public function classes(){
        return $this->belongsTo('App\Models\Admin\Classes','class_id', 'id');
    }

    public function teachers(){
        return $this->belongsTo('App\Models\Admin\Teacher','teacher_id', 'id');
    }
}
