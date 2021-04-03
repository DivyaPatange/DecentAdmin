<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AcademicYear;
use App\Models\Admin\Classes;

class FeeReportController extends Controller
{
    public function totalFeeCollectionIndex()
    {
        $academicYear = AcademicYear::where('status', 1)->get();
        $classes = Classes::where('status', 1)->get();
        return view('admin.fee-report.total-fee-collection', compact('classes', 'academicYear'));
    }
}
