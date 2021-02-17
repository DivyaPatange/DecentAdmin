<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allotment extends Model
{
    use HasFactory;

    protected $table = "allotments";

    protected $fillable = ['collage_ID', 'class_id', 'academic_id', 'status'];
}
