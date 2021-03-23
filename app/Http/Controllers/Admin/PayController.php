<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Pay;
use App\Models\Admin\Admission;
use App\Models\Admin\Classes;
use App\Models\Admin\Section;
use App\Models\Admin\Student;
use App\Models\Admin\Fee;
use DB;

class PayController extends Controller
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
        $classes = Classes::where('status', 1)->get();
        if(request()->ajax()) {
            if(!empty($request->classID) || !empty($request->sectionID) || !empty($request->student) || !empty($request->date_from) || !empty($request->date_to)){
                $payment = Pay::where('class_id', $request->classID)->where('section_id', $request->sectionID)->where('student_id', $request->student)->whereBetween('payment_date', [$request->date_from, $request->date_to])->get();
            }
            else{
                $payment = Pay::orderBy('id', 'DESC')->get();
            }
            return datatables()->of($payment)
            ->addColumn('student_name', function($row){    
                $student = Student::where('id', $row->student_id)->first();
                if(!empty($student))
                {
                    return $student->student_name;
                }                                                                                                                                                                                                                                                                                              
            })
            ->addColumn('class', function($row){    
                $student = Student::where('id', $row->student_id)->first();
                if(!empty($student))
                {
                    $class = Classes::where('id', $student->class_id)->first();
                    if(!empty($class))
                    {
                        return $class->class_name;
                    }
                }                                                                                                                                                                                                                                                                                              
            })
            ->addColumn('section', function($row){    
                $student = Student::where('id', $row->student_id)->first();
                if(!empty($student))
                {
                    $section = Section::where('id', $student->section_id)->first();
                    if(!empty($section))
                    {
                        return $section->section_name;
                    }
                }                                                                                                                                                                                                                                                                                              
            })
            ->addColumn('roll_no', function($row){    
                $student = Student::where('id', $row->student_id)->first();
                if(!empty($student))
                {
                   return $student->roll_no;
                }                                                                                                                                                                                                                                                                                              
            })
            ->addColumn('action', 'admin.payment.action')
            ->rawColumns(['academic_id', 'action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.payment.index', compact('classes'));
    }

    public function getStudentList(Request $request)
    {
        $student = DB::table('students')->where("class_id", $request->classID)->where('section_id', $request->sectionID)
        ->pluck("student_name","id");
        // return $student;
        return response()->json($student);
    }

    public function getStudentName(Request $request)
    {
        if($request->regi_no){
            $student = Student::where('regi_no', $request->regi_no)->first();
            $fees = Fee::where('class_id', $student->class_id)
            ->where('status', 1)
            ->with('fee_head')
            ->get()
            ->pluck('fee_head.fee_head', 'id');
            return response()->json(['name' => $student->student_name, 'fees' => $fees]);
        }
        elseif($request->roll_no && $request->classs && $request->section)
        {
            $student = Student::where('roll_no', $request->roll_no)->where('class_id', $request->classs)->where('section_id', $request->section)->first();
            $fees = Fee::where('class_id', $student->class_id)
            ->where('status', 1)
            ->with('fee_head')
            ->get()
            ->pluck('fee_head.fee_head', 'id');
            return response()->json(['name' => $student->student_name, 'fees' => $fees]);
        }
    }

    public function getFeeAmount(Request $request)
    {
        $fees = Fee::where('id', $request->fee_id)
        ->where('status', 1)
        ->with('fee_head')
        ->get()
        ->pluck('fee_head.fee_head', 'amount');
        return response()->json(['id' => $request->fee_id, 'fees' => $fees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::where('status', 1)->get();
        return view('admin.payment.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paymentLogs = \DB::table('pays')->where('id', \DB::raw("(select max(`id`) from pays)"))->first();
        // dd($paymentLogs);
        $payment = new Pay();
        $payment->admission_id = $request->id;
        $payment->adm_sought = $request->adm_sought;
        $payment->fee_id = $request->fee_head;
        $payment->payment_amount = $request->pay_amt;
        $payment->payment_date = $request->pay_date;
        $payment->due_date = $request->due_date;
        if($paymentLogs == null)
        {
            $payment->receipt_no = 1021;
        }
        else{
            $payment->receipt_no = $paymentLogs->receipt_no + 1;
        }
        $payment->save();
        return response()->json(['success' => 'Payment is Successfully Done']);
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
        // dd($admission);
        $fees = DB::table('fees')->where('class_id', $admission->adm_sought)->where('academic_id', $admission->academic_id)->get()->sum('amount');
        $feeHead = DB::table('fees')->where('class_id', $admission->adm_sought)->where('academic_id', $admission->academic_id)->get();
        // dd($fees);
        $payment = Pay::where('admission_id', $admission->id)->where('adm_sought', $admission->adm_sought)->get()->sum('payment_amount');
        $paymentLogs = Pay::where('admission_id', $admission->id)->where('adm_sought', $admission->adm_sought)->get();
        if(request()->ajax()) {
            return datatables()->of($paymentLogs)
            ->addColumn('fee_head', function(Pay $pay){
               if(!empty($pay->fee_head->fee_head))
               {
                   return $pay->fee_head->fee_head;
               }
            })
            ->addColumn('action', function($paymentLogs){
                $button = '<button data-id="'.$paymentLogs->id.'" id="receipt" class="btn waves-effect waves-dark btn-warning btn-outline-warning btn-icon">
                <i class="icofont icofont-file-alt mr-0"></i>
              </button>';
            return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.payment.view', compact('admission', 'fees', 'payment', 'paymentLogs', 'feeHead'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getPayment(Request $request)
    {
        $admission = JuniorAdmission::where('id', $request->bid)->where('adm_sought', $request->adm_sought)->first();
        if (!empty($admission)) 
        {
            $totalPay = DB::table('fees')->where('class_id', $admission->adm_sought)->where('academic_id', $admission->academic_id)->get()->sum('amount');
            $payment = Pay::where('admission_id', $admission->id)->where('adm_sought', $admission->adm_sought)->get()->sum('payment_amount');
            $balAmt = $totalPay - $payment;
            $data = array('id' =>$admission->id,'amount_pay' =>$totalPay,'adv_amount'=>$payment,'bal_amount' =>$balAmt
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function receipt($id)
    {
        $payment = Pay::findorfail($id);
        $admission = JuniorAdmission::where('id', $payment->admission_id)->first();
        // dd($admission);
        return view('admin.payment.receipt', compact('admission', 'payment'));
    }

    public function receiptSave(Request $request)
    {
        $payment = Pay::where('id', $request->id)->first();
        $payment->pay_by = $request->pay_by;
        $payment->pay_by_no = $request->pay_by_no;
        $payment->pay_by_date = $request->pay_date;
        $payment->update($request->all());
    }

    public function primarySchoolList(Request $request)
    {
        $admission = PrimarySchool::orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($admission)
            ->addColumn('academic_id', function(PrimarySchool $prSchool){
                if(!empty($prSchool->sessions->from_academic_year) && !empty($prSchool->sessions->to_academic_year)){
                return '('.$prSchool->sessions->from_academic_year.') - ('.$prSchool->sessions->to_academic_year.')';
                }
            })
            ->addColumn('action', 'admin.payment.prSchool')
            ->rawColumns(['academic_id', 'action'])
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function getSchoolPayment($id)
    {
        $admission = PrimarySchool::findorfail($id);
        // dd($admission);
        $fees = DB::table('fees')->where('class_id', $admission->adm_sought)->where('academic_id', $admission->academic_id)->get()->sum('amount');
        $feeHead = DB::table('fees')->where('class_id', $admission->adm_sought)->where('academic_id', $admission->academic_id)->get();
        // dd($fees);
        $payment = Pay::where('admission_id', $admission->id)->where('adm_sought', $admission->adm_sought)->get()->sum('payment_amount');
        $paymentLogs = Pay::where('admission_id', $admission->id)->where('adm_sought', $admission->adm_sought)->get();
        if(request()->ajax()) {
            return datatables()->of($paymentLogs)
            ->addColumn('fee_head', function(Pay $pay){
               if(!empty($pay->fee_head->fee_head))
               {
                   return $pay->fee_head->fee_head;
               }
            })
            ->addColumn('action', function($paymentLogs){
                $button = '<button data-id="'.$paymentLogs->id.'" id="receipt" class="btn waves-effect waves-dark btn-warning btn-outline-warning btn-icon">
                <i class="icofont icofont-file-alt mr-0"></i>
              </button>';
            return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.payment.school-payment', compact('admission', 'fees', 'payment', 'paymentLogs', 'feeHead'));
    }

    public function getSchoolPaymentDetails(Request $request)
    {
        $admission = PrimarySchool::where('id', $request->bid)->where('adm_sought', $request->adm_sought)->first();
        if (!empty($admission)) 
        {
            $totalPay = DB::table('fees')->where('class_id', $admission->adm_sought)->where('academic_id', $admission->academic_id)->get()->sum('amount');
            $payment = Pay::where('admission_id', $admission->id)->where('adm_sought', $admission->adm_sought)->get()->sum('payment_amount');
            $balAmt = $totalPay - $payment;
            $data = array('id' =>$admission->id,'amount_pay' =>$totalPay,'adv_amount'=>$payment,'bal_amount' =>$balAmt
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }
}
