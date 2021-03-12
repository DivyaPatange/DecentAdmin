<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = "classes";

    protected $fillable = ['class_name', 'numeric_value', 'is_open_for_adm', 'status'];

    public function allotments(){
        return $this->hasMany('App\Models\Admin\Allotment','class_id', 'id');
    }

    public function sections(){
        return $this->hasMany('App\Models\Admin\Section','class_id', 'id');
    }
}
