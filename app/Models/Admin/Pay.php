<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;

    protected $table = "pays";

    protected $fillable = ['admission_id', 'fee_id', 'receipt_no', 'payment_amount', 'payment_date'];
    
    public function fee_head(){
        return $this->belongsTo('App\Models\Admin\FeeHead','fee_id', 'id');
    }
}
