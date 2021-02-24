<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $table = "visitors";

    protected $fillable = ['visit_date', 'visit_time','temp', 'visitor_name', 'student_name', 'phone_no', 'address', 'purpose'];
}
