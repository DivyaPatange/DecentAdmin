<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    use HasFactory;

    protected $table = "standards";
    protected $fillable = ['standard', 'status'];

    public function fees(){
        return $this->hasMany('App\Models\Admin\Fee','class_id', 'standard');
    }
}
