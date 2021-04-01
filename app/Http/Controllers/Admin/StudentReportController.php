<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AcademicYear;
use App\Models\Admin\Classes;
use App\Models\Admin\Section;
use App\Models\Admin\Student;
use DB;
use App\Models\Admin\StudentAttendance;
use App\Models\Admin\AttendanceStudentList;

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
        $academicYear = AcademicYear::where('id', $request->academic_id)->first();
        if(!empty($academicYear)){
            $academic_year = '('.$academicYear->from_academic_year.') - ('.$academicYear->to_academic_year.')';
        }
        else{
            $academic_year = '';
        }
        $classes = Classes::where('id', $request->class_id)->first();
        if(!empty($classes)){
            $class_name = $classes->class_name;
        }
        else{
            $class_name = '';
        }
        $section = Section::where('id', $request->section_id)->first();
        if(!empty($section)){
            $section_name = $section->section_name;
        }
        else{
            $section_name = '';
        }
        $output = '';
        foreach($student as $s)
        {   $studAttend = DB::table('attendance_student_lists')->where('student_id', $s->id)->join('student_attendances', 'attendance_student_lists.stud_attendance_id', '=', 'student_attendances.id')
            ->select('student_attendances.attendance_date', 'attendance_student_lists.status')
            ->where('student_attendances.attendance_date', $date)
            ->first();
            if(!empty($studAttend)){
            $output .= '<tr>'.
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->student_name.'</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->regi_no.'</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->roll_no.'</td>';
                
                if(!empty($studAttend)){
                    $output .='<td style="border: 1px solid black; border-collapse: collapse;">'.$studAttend->status.'</td>';
                }
                $output .='<td style="border: 1px solid black; border-collapse: collapse;"></td>'.
            '</tr>';
            }
        }
        return response()->json(['success' => 'Data Found', 'date' => $date, 'output' => $output, 'academic_year' => $academic_year, 'class_name' => $class_name, 'section' => $section_name]);
    }

    public function dateRangeAttendanceIndex()
    {
        $academicYear = AcademicYear::where('status', 1)->get();
        $classes = Classes::where('status', 1)->get();
        return view('admin.student-report.date-range-attendance.index', compact('academicYear', 'classes'));
    }

    public function getStudentDateRangeAttendance(Request $request)
    {
        $student = Student::where('academic_id', $request->academic_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->get();
        $date = $request->date_from.' to '.$request->date_to;
        $academicYear = AcademicYear::where('id', $request->academic_id)->first();
        if(!empty($academicYear)){
            $academic_year = '('.$academicYear->from_academic_year.') - ('.$academicYear->to_academic_year.')';
        }
        else{
            $academic_year = '';
        }
        $classes = Classes::where('id', $request->class_id)->first();
        if(!empty($classes)){
            $class_name = $classes->class_name;
        }
        else{
            $class_name = '';
        }
        $section = Section::where('id', $request->section_id)->first();
        if(!empty($section)){
            $section_name = $section->section_name;
        }
        else{
            $section_name = '';
        }
        $output = '';
        foreach($student as $s)
        {   $studAttend = AttendanceStudentList::where('student_id', $s->id)->get();
            // var_dump($studAttend);
            if(count($studAttend) > 0){
            $output .= '<tr>'.
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->student_name.'</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->regi_no.'</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->roll_no.'</td>';
                
                if(count($studAttend) > 0){
                    $output .='<td style="border: 1px solid black; border-collapse: collapse;">'. 
                    '<table style="width:100%;text-align:center;border: 1px solid black; border-collapse: collapse;">';
                    foreach($studAttend as $sa){
                        $attendance = StudentAttendance::where('id', $sa->stud_attendance_id)->first();
                        if(($attendance->attendance_date >= $request->date_from) && ($attendance->attendance_date <= $request->date_to)){
                        $output .='<tr>'. 
                            '<td style="text-align:center;border: 1px solid black; border-collapse: collapse;">'.$attendance->attendance_date.'</td>'. 
                            '<td style="text-align:center;border: 1px solid black; border-collapse: collapse;">'.$sa->status.'</td>'.
                        '</tr>';
                        }
                    }
                    $output .='</table>'.
                    '</td>';
                }
                $output .='</tr>';
            }
        }
        return response()->json(['success' => 'Data Found', 'date' => $date, 'output' => $output, 'academic_year' => $academic_year, 'class_name' => $class_name, 'section' => $section_name]);
    }

    public function monthlyAttendanceIndex()
    {
        $academicYear = AcademicYear::where('status', 1)->get();
        $classes = Classes::where('status', 1)->get();
        return view('admin.student-report.monthly-attendance.index', compact('academicYear', 'classes'));
    }

    public function getStudentMonthlyAttendance(Request $request)
    {
        $date = $request->date;
        $explodeMonth = explode("-", $date);
        $year = $explodeMonth[0];
        $month = $explodeMonth[1];
        $academicYear = AcademicYear::where('id', $request->academic_id)->first();
        if(!empty($academicYear)){
            $academic_year = '('.$academicYear->from_academic_year.') - ('.$academicYear->to_academic_year.')';
        }
        else{
            $academic_year = '';
        }
        $classes = Classes::where('id', $request->class_id)->first();
        if(!empty($classes)){
            $class_name = $classes->class_name;
        }
        else{
            $class_name = '';
        }
        $section = Section::where('id', $request->section_id)->first();
        if(!empty($section)){
            $section_name = $section->section_name;
        }
        else{
            $section_name = '';
        }
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $student = Student::where('academic_id', $request->academic_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->get();
        // return $days;
        $output = '';
        $output .= '<tr>'. 
            '<th rowspan="2" style="text-align:center;border: 1px solid black; border-collapse: collapse;">Name</th>'. 
            '<th rowspan="2" style="text-align:center;border: 1px solid black; border-collapse: collapse;">Roll No.</th>'. 
            '<th rowspan="2" style="text-align:center;border: 1px solid black; border-collapse: collapse;">Regi No.</th>'.
            '<th colspan="'.$days.'" style="text-align:center;border: 1px solid black; border-collapse: collapse;">Day of Month</th>'.
        '</tr>'. 
        '<tr>';
        for($i=1; $i <= $days; $i++){ 
        $output .= '<th style="text-align:center;border: 1px solid black; border-collapse: collapse;">'.$i.'</th>';
        }
        $output .= '</tr>';
        foreach($student as $s)
        {   
            $output .= '<tr>'.
            '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->student_name.'</td>'. 
            '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->regi_no.'</td>'. 
            '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->roll_no.'</td>';
            for($i=1; $i <= $days; $i++)
            { 
                $date1 = $year.'-'.$month.'-'.$i;
                $output .= '<td style="border: 1px solid black; border-collapse: collapse;">';
                $studAttend = AttendanceStudentList::where('student_id', $s->id)->where('attendance_date', $date1)->first();
                if(!empty($studAttend))
                {
                    if($studAttend->status == "Present"){
                    $output .= 'P';
                    }
                    else{
                        $output .= 'A';
                    }
                }
                $output .= '</td>';
            }
        }
        return response()->json(['success' => 'Data Found', 'date' => $date, 'output' => $output, 'academic_year' => $academic_year, 'class_name' => $class_name, 'section' => $section_name]);
    }

    public function monthlyAbsentIndex()
    {
        $academicYear = AcademicYear::where('status', 1)->get();
        $classes = Classes::where('status', 1)->get();
        return view('admin.student-report.monthly-absent.index', compact('academicYear', 'classes'));
    }

    public function getStudentMonthlyAbsentList(Request $request)
    {
        $date = $request->date;
        $explodeMonth = explode("-", $date);
        $year = $explodeMonth[0];
        $month = $explodeMonth[1];
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $academicYear = AcademicYear::where('id', $request->academic_id)->first();
        if(!empty($academicYear)){
            $academic_year = '('.$academicYear->from_academic_year.') - ('.$academicYear->to_academic_year.')';
        }
        else{
            $academic_year = '';
        }
        $classes = Classes::where('id', $request->class_id)->first();
        if(!empty($classes)){
            $class_name = $classes->class_name;
        }
        else{
            $class_name = '';
        }
        $section = Section::where('id', $request->section_id)->first();
        if(!empty($section)){
            $section_name = $section->section_name;
        }
        else{
            $section_name = '';
        }
        $student = Student::where('academic_id', $request->academic_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->get();
        $output = '';
        foreach($student as $s)
        { 
            $output .= '<tr>'.
            '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->student_name.'</td>'. 
            '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->regi_no.'</td>'. 
            '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->roll_no.'</td>'. 
            '<td><table style="border: 1px solid black; border-collapse: collapse;width:100%">';
            for($i=1; $i <= $days; $i++)
            { 
                $date1 = $year.'-'.$month.'-'.$i;
                $studAttend = AttendanceStudentList::where('student_id', $s->id)->where('attendance_date', $date1)->where('status', '=', 'Absent')->first();
                if(!empty($studAttend))
                {
                    $output .= '<tr>'.
                    '<td style="border: 1px solid black; border-collapse: collapse;">'.$studAttend->attendance_date.'</td>'.
                    '<td style="border: 1px solid black; border-collapse: collapse;">'.$studAttend->status.'</td>'.
                    '</tr>';
                }
            }
            $output .= '</table></td>';
        }
        return response()->json(['success' => 'Data Found', 'date' => $date, 'output' => $output, 'academic_year' => $academic_year, 'class_name' => $class_name, 'section' => $section_name]);
    }
}
