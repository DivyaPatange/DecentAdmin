<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Teacher;
use App\Models\Admin\AttendanceEmployeeList;

class HRMReportController extends Controller
{
    public function employeeDailyAttendanceIndex()
    {
        return view('admin.hrm-report.daily-attendance.index');
    }

    public function getEmployeeDailyAttendance(Request $request)
    {
        $employee = Teacher::where('role_type', '=', $request->employee_type)->get();
        $date = $request->date;
        $employee_type = $request->employee_type;
        $output = ''; 
        foreach($employee as $key => $e)
        {
            $empAttendance = AttendanceEmployeeList::where('teacher_id', $e->id)->where('attendance_date', $request->date)->first();
            if(!empty($empAttendance)){
                $output .= '<tr>'. 
                    '<td style="border: 1px solid black; border-collapse: collapse;">'.++$key.'</td>'. 
                    '<td style="border: 1px solid black; border-collapse: collapse;">'.$e->name.'</td>'. 
                    '<td style="border: 1px solid black; border-collapse: collapse;">'.$e->employee_id.'</td>'. 
                    '<td style="border: 1px solid black; border-collapse: collapse;">'.$e->designation.'</td>'.
                    '<td style="border: 1px solid black; border-collapse: collapse;">'.$empAttendance->status.'</td>'.
                '</tr>';
            }
        }
        return response()->json(['success' => 'Data Found', 'date' => $date, 'output' => $output, 'emp_type' => $employee_type]);
    }

    public function employeeDateRangeAttendanceIndex()
    {
        return view('admin.hrm-report.date-range-attendance.index');
    }

    public function getEmployeeDateRangeAttendance(Request $request)
    {
        $employee = Teacher::where('role_type', $request->employee_type)->get();
        $employee_type = $request->employee_type;
        $date = $request->date_from.' to '.$request->date_to;
        $output = '';
        foreach($employee as $key => $s)
        {   
            $studAttend = AttendanceEmployeeList::where('teacher_id', $s->id)->whereBetween('attendance_date', [$request->date_from, $request->date_to])->get();
            // var_dump($studAttend);
            if(count($studAttend) > 0){
            $output .= '<tr>'.
                '<td style="border: 1px solid black; border-collapse: collapse;">'.++$key.'</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->name.'</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->employee_id.'</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->designation.'</td>';
                
                if(count($studAttend) > 0){
                    $output .='<td style="border: 1px solid black; border-collapse: collapse;">'. 
                    '<table style="width:100%;text-align:center;border: 1px solid black; border-collapse: collapse;">';
                    foreach($studAttend as $sa){
                        $output .='<tr>'. 
                            '<td style="text-align:center;border: 1px solid black; border-collapse: collapse;">'.$sa->attendance_date.'</td>'. 
                            '<td style="text-align:center;border: 1px solid black; border-collapse: collapse;">'.$sa->status.'</td>'.
                        '</tr>';
                    }
                    $output .='</table>'.
                    '</td>';
                }
                $output .='</tr>';
            }
        }
        return response()->json(['success' => 'Data Found', 'date' => $date, 'output' => $output, 'emp_type' => $employee_type]);
    }

    public function monthlyAttendanceIndex()
    {
        return view('admin.hrm-report.monthly-attendance.index');
    }

    public function getEmployeeMonthlyAttendance(Request $request)
    {
        $date = $request->date;
        $employee_type = $request->employee_type;
        $explodeMonth = explode("-", $date);
        $year = $explodeMonth[0];
        $month = $explodeMonth[1];
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $employees = Teacher::where('role_type', $request->employee_type)->get();
        $output = '';
        $output .= '<tr>'. 
            '<th rowspan="2" style="text-align:center;border: 1px solid black; border-collapse: collapse;">Employee Name</th>'. 
            '<th rowspan="2" style="text-align:center;border: 1px solid black; border-collapse: collapse;">Employee ID</th>'. 
            '<th rowspan="2" style="text-align:center;border: 1px solid black; border-collapse: collapse;">Designation</th>'.
            '<th colspan="'.$days.'" style="text-align:center;border: 1px solid black; border-collapse: collapse;">Day of Month</th>'.
        '</tr>'. 
        '<tr>';
        for($i=1; $i <= $days; $i++){ 
            $output .= '<th style="text-align:center;border: 1px solid black; border-collapse: collapse;">'.$i.'</th>';
        }
        $output .= '</tr>';
        foreach($employees as $s)
        {   
            $output .= '<tr>'.
            '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->name.'</td>'. 
            '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->employee_id.'</td>'. 
            '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->designation.'</td>';
            for($i=1; $i <= $days; $i++)
            { 
                $date1 = $year.'-'.$month.'-'.$i;
                $output .= '<td style="border: 1px solid black; border-collapse: collapse;">';
                $studAttend = AttendanceEmployeeList::where('teacher_id', $s->id)->where('attendance_date', $date1)->first();
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
            $output .= '</tr>';
        }
        return response()->json(['success' => 'Data Found', 'date' => $date, 'output' => $output, 'emp_type' => $employee_type]);
    }

    public function monthlyAbsentIndex()
    {
        return view('admin.hrm-report.monthly-absent.index');
    }

    public function getEmployeeMonthlyAbsentList(Request $request)
    {
        $date = $request->date;
        $employee_type = $request->employee_type;
        $explodeMonth = explode("-", $date);
        $year = $explodeMonth[0];
        $month = $explodeMonth[1];
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $employee = Teacher::where('role_type', $request->employee_type)->get();
        $output = '';
        foreach($employee as $s)
        { 
            $output .= '<tr>'.
            '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->name.'</td>'. 
            '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->employee_id.'</td>'. 
            '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->designation.'</td>'. 
            '<td><table style="border: 1px solid black; border-collapse: collapse;width:100%">';
            for($i=1; $i <= $days; $i++)
            { 
                $date1 = $year.'-'.$month.'-'.$i;
                $studAttend = AttendanceEmployeeList::where('teacher_id', $s->id)->where('attendance_date', $date1)->where('status', '=', 'Absent')->first();
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
        return response()->json(['success' => 'Data Found', 'date' => $date, 'output' => $output, 'emp_type' => $employee_type]);
    }

    public function employeeListIndex()
    {
        return view('admin.hrm-report.employee-list.index');
    }

    public function getEmployeeList(Request $request)
    {
        $employee = Teacher::where('role_type', $request->employee_type)->get();
        $employee_type = $request->employee_type;
        $output = '';
        foreach($employee as $key => $s)
        {
            $output .= '<tr>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.++$key.'</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->name.'</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->designation.'</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->qualification.'</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->gender.'</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->email.'</td>'.
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->mobile_no.'</td>'.
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$s->address.'</td>'.
                '<td style="border: 1px solid black; border-collapse: collapse;">';
                if($s->status == 1){
                    $output .= "Present";
                }
                else{
                    $output .= "Absent";
                }
                $output .='</td>'.
            '</tr>';
        }
        return response()->json(['success' => 'Data Found', 'output' => $output, 'emp_type' => $employee_type]);
    }
}
