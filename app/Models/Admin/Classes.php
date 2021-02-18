<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = "classes";

    protected $fillable = ['standard', 'section', 'status', 'class'];

    public function allotments(){
        return $this->hasMany('App\Models\Admin\Allotment','class_id', 'id');
    }
}
