<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;

    protected $table = "pays";

    protected $fillable = ['student_id', 'class_id', 'section_id', 'fee_id', 'receipt_no', 'payment_amount', 'payment_date', 'discount', 'due_date', 'due_amount', 'payment_method', 'payment_method_no', 'payment_method_date', 'created_by', 'status'];
    
    public function fee_head(){
        return $this->belongsTo('App\Models\Admin\FeeHead','fee_id', 'id');
    }
}
