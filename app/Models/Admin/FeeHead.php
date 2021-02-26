<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeHead extends Model
{
    use HasFactory;

    protected $table = "fee_heads";
    protected $fillable = ['fee_head', 'description', 'status'];

    public function fees(){
        return $this->hasMany('App\Models\Admin\Fee','fee_head_id', 'id');
    }
    
    public function pay_fees(){
        return $this->hasMany('App\Models\Admin\Pay','fee_id', 'id');
    }
}
