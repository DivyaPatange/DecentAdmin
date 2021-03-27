<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueBook extends Model
{
    use HasFactory;

    protected $table = "issue_books";

    protected $fillable = ['student_id', 'student_regi_no', 'book_code', 'issue_date', 'return_date', 'quantity'];
}
