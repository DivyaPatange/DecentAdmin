<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Pay;
use App\Models\Admin\JuniorAdmission;
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
        $admission = JuniorAdmission::orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($admission)
            ->addColumn('academic_id', function(JuniorAdmission $juniorAdmission){
                if(!empty($juniorAdmission->sessions->from_academic_year) && !empty($juniorAdmission->sessions->to_academic_year)){
                return '('.$juniorAdmission->sessions->from_academic_year.') - ('.$juniorAdmission->sessions->to_academic_year.')';
                }
            })
            ->addColumn('action', 'admin.payment.action')
            ->rawColumns(['academic_id', 'action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.payment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $payment = Pay::where('admission_id', $admission->id)->get()->sum('payment_amount');
        $paymentLogs = Pay::where('admission_id', $admission->id)->get();
        if(request()->ajax()) {
            return datatables()->of($paymentLogs)
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
        $admission = JuniorAdmission::where('id', $request->bid)->first();
        if (!empty($admission)) 
        {
            $totalPay = DB::table('fees')->where('class_id', $admission->adm_sought)->where('academic_id', $admission->academic_id)->get()->sum('amount');
            $payment = Pay::where('admission_id', $admission->id)->get()->sum('payment_amount');
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
        return view('admin.payment.receipt');
    }
}
