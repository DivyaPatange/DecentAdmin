<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AcademicYear;
use App\Models\Admin\JuniorAdmission;
use App\Models\Admin\Student;
use App\Models\Admin\Parents;
use Illuminate\Support\Facades\Hash;

class JuniorAdmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admission = JuniorAdmission::all();
        if(request()->ajax()) {
            return datatables()->of($admission)
            ->addColumn('academic_id', function(JuniorAdmission $juniorAdmission){
                if(!empty($juniorAdmission->sessions->from_academic_year) && !empty($juniorAdmission->sessions->to_academic_year)){
                return '('.$juniorAdmission->sessions->from_academic_year.') - ('.$juniorAdmission->sessions->to_academic_year.')';
                }
            })
            ->addColumn('action', 'admin.jrAdmission.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.jrAdmission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $academicYear = AcademicYear::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('admin.jrAdmission.create', compact('academicYear'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admission = new JuniorAdmission();
        $admission->admission_reg_no = $request->admission_reg_no;
        $admission->admission_date = $request->admission_date;
        $admission->academic_id = $request->academic_session;
        $admission->student_name = $request->student_name;
        $admission->father_name = $request->father_name;
        $admission->mother_name = $request->mother_name;
        $admission->f_occupation = $request->father_occupation;
        $admission->m_occupation = $request->mother_occupation;
        $admission->mobile_no = $request->mobile_no;
        $admission->adhaar_no = $request->adhaar_no;
        $admission->id_no = $request->id_no;
        $admission->date_of_birth = $request->date_of_birth;
        $admission->religion = $request->religion;
        $admission->caste = $request->caste;
        $admission->sub_caste = $request->sub_caste;
        $admission->address = $request->address;
        $admission->last_exam_passed = $request->last_exam_passed;
        $admission->percentage = $request->percentage;
        $admission->math_mark = $request->math_mark;
        $admission->science_mark = $request->science_mark;
        $admission->out_of = $request->out_of;
        $admission->last_school_attended = $request->last_school_attended;
        $admission->board = $request->board;
        $admission->other_board = $request->other_board;
        $admission->adm_sought = $request->adm_sought;
        $admission->stream = $request->stream;
        $admission->status = 0; 
        $image = $request->file('student_photo');
        // dd($request->file('photo'));
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('studentPhoto'), $image_name);
            $admission->student_photo =$image_name;
        }
        $admission->save();
        if($request->collage_id_no)
        {
            $student = Student::where('collage_ID', $request->collage_id_no)->first();
            if(empty($student))
            {
                $id = mt_rand(10000,99999);
                $students = new Student();
                $students->collage_ID = "DEC".$id;
                $students->save();
                
                $updateAdmission = JuniorAdmission::where('id', $admission->id)->update(['collage_ID' => $students->collage_ID]);

                $password = str_random(8);
                $parents = new Parents();
                $parents->username = $students->collage_ID;
                $parents->password = Hash::make($password);
                $parents->password_1 = $password;
                $parents->save();
            }
            else{
                $updateAdmission = JuniorAdmission::where('id', $admission->id)->update(['collage_ID' => $student->collage_ID]);
            }
        }
        else{
            $id = mt_rand(10000,99999);
            $students = new Student();
            $students->collage_ID = "DEC".$id;
            $students->save();

            $updateAdmission = JuniorAdmission::where('id', $admission->id)->update(['collage_ID' => $students->collage_ID]);
            
            $password = str_random(8);
            $parents = new Parents();
            $parents->username = $students->collage_ID;
            $parents->password = Hash::make($password);
            $parents->password_1 = $password;
            $parents->save();
        }
        return redirect('/admin/junior-college-admission')->with('success', 'Admission Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admission = JuniorAdmission::findorfail($id);
        return view('admin.jrAdmission.view', compact('admission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $academicYear = AcademicYear::where('status', 1)->orderBy('id', 'DESC')->get();
        $admission = JuniorAdmission::findorfail($id);
        return view('admin.jrAdmission.edit', compact('admission', 'academicYear'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admission = JuniorAdmission::findorfail($id);
        $image_name = $request->hidden_image;
        $image = $request->file('student_photo');
        if($image != '')
        {
            
        $image_name = rand() . '.' . $image->getClientOriginalExtension();
        // $image->storeAs('public/tempcourseimg',$image_name);
        $image->move(public_path('studentPhoto'), $image_name);
        }
        $input_data = array (
            'admission_reg_no' => $request->admission_reg_no,
            'admission_date' => $request->admission_date,
            'academic_id' => $request->academic_session,
            'student_name' => $request->student_name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'f_occupation' => $request->father_occupation,
            'm_occupation' => $request->mother_occupation,
            'mobile_no' => $request->mobile_no,
            'adhaar_no' => $request->adhaar_no,
            'id_no' => $request->id_no,
            'date_of_birth' => $request->date_of_birth,
            'religion' => $request->religion,
            'caste' => $request->caste,
            'sub_caste' => $request->sub_caste,
            'address' => $request->address,
            'last_exam_passed' => $request->last_exam_passed,
            'percentage' => $request->percentage,
            'math_mark' => $request->math_mark,
            'science_mark' => $request->science_mark,
            'out_of' => $request->out_of,
            'last_school_attended' => $request->last_school_attended,
            'board' => $request->board,
            'other_board' => $request->other_board,
            'adm_sought' => $request->adm_sought,
            'stream' => $request->stream,
            'student_photo' => $image_name,
        );
        $admission = JuniorAdmission::whereId($id)->update($input_data);
        return redirect('/admin/junior-college-admission')->with('success', 'Admission Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admission = JuniorAdmission::findorfail($id);
        if($admission->student_photo){
            unlink(public_path('studentPhoto/'.$admission->student_photo));
        }
        $admission->delete();
        return response()->json(['success' => 'Admission Deleted Successfully']);
    }

    public function searchStudentName(Request $request)
    {
        if($request->ajax()) {
            // select country name from database
            $data = Student::where('collage_ID', 'LIKE', $request->collage_id_no.'%')
                ->get();
                
        
            // declare an empty array for output
            $output = '';
            // if searched countries count is larager than zero
            if (count($data)>0) {
                // concatenate output to the array
                // loop through the result array
                foreach ($data as $row){
                    // dd($request->user_referral_info == $row->referral_code);
                    if($request->collage_id_no == $row->collage_ID){
                    // concatenate output to the array
                        $student = JuniorAdmission::where('id', $row->admission_id)->first();
                        if(!empty($student)){
                       $output .= $student->student_name;
                        }
                        else{
                            $output .= 'No Result';
                        }
                        
                    }
                }
                // end of output
            }
            
            else {
                // if there's no matching results according to the input
                $output .= 'No results';
            }
            // return output result array
            return $output;
        }
    }
}
