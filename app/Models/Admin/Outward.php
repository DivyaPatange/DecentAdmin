<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outward extends Model
{
    use HasFactory;

    protected $table = "outwards";

    protected $fillable = ['document_name', 'out_date', 'issued_to', 'message'];
}
