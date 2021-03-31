<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AcademicYear;
use App\Models\Admin\Classes;
use App\Models\Admin\Student;

class StudentReportController extends Controller
{
    public function dailyAttendanceIndex()
    {
        $academicYear = AcademicYear::where('status', 1)->get();
        $classes = Classes::where('status', 1)->get();
        return view('admin.student-report.daily-attendance.index', compact('academicYear', 'classes'));
    }

    public function getStudentDailyAttendance(Request $request)
    {
        $student = Student::where('academic_id', $request->academic_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->get();
        $date = $request->date;
        return view('admin.student-report.daily-attendance.print', compact('student', 'date'));
    }
}
