<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeavePolicy extends Model
{
    use HasFactory;

    protected $table = "leave_policies";
    protected $fillable = ['casual_leave', 'sick_leave', 'maternity_leave', 'special_leave'];

}
