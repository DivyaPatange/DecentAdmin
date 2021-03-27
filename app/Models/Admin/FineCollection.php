<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FineCollection extends Model
{
    use HasFactory;

    protected $table = "fine_collections";

    protected $fillable = ['student_id', 'student_regi_no', 'collection_date', 'fine_amt', 'description'];
}
