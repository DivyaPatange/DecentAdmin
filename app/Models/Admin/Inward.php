<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inward extends Model
{
    use HasFactory;

    protected $table = "inwards";

    protected $fillable = ['document_name', 'in_date', 'received_from', 'dept', 'message'];
}
