<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\FineCollection;
use App\Models\Admin\Classes;
use App\Models\Admin\Student;
use DB;

class LibraryFineController extends Controller
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
    public function index(Request $request)
    {
        $classes = Classes::where('status', 1)->get();
        if(request()->ajax()) {
            $libraryFine1 = DB::table('fine_collections');
            if(isset($request->classID) && isset($request->sectionID) && isset($request->student))
            {
                $libraryFine1 = $libraryFine1->where('student_id', $request->student); 
            }
            if(!empty($request->date_from) && !empty($request->date_to)){
                $libraryFine1 = $libraryFine1->whereBetween('collection_date', [date("Y-m-d", strtotime($request->date_from)), date("Y-m-d", strtotime($request->date_to))]);
            }
            $libraryFine = $libraryFine1->orderBy('id', 'DESC')->get();
            return datatables()->of($libraryFine)
            ->addColumn('student_name', function($row){
                $studentName = Student::where('id', $row->student_id)->first();
                if(!empty($studentName))
                {
                    return $studentName->student_name;
                }
            })
            ->addColumn('action', 'admin.library-fine.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.library-fine.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.library-fine.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = Student::where('regi_no', $request->regi_no)->first();
        if(empty($student))
        {
            return response()->json(['error' => 'Student Regi. No. Not Found']);
        }
        else{
            $libraryFine = new FineCollection();
            $libraryFine->student_id = $student->id;
            $libraryFine->student_regi_no = $request->regi_no;
            $libraryFine->collection_date = $request->collect_date;
            $libraryFine->fine_amt = $request->fine_amt;
            $libraryFine->description = $request->description;
            $libraryFine->save();
            return response()->json(['success' => 'Library Fine Added Successfully!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $libraryFine = FineCollection::findorfail($id);
        return view('admin.library-fine.edit', compact('libraryFine'));
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
        $libraryFine = FineCollection::findorfail($id);
        $student = Student::where('regi_no', $request->regi_no)->first();
        if(empty($student))
        {
            return response()->json(['error' => 'Student Regi. No. Not Found']);
        }
        else{
            $input_data = array (
                'student_id' => $student->id,
                'student_regi_no' => $request->regi_no,
                'collection_date' => $request->collect_date,
                'fine_amt' => $request->fine_amt,
                'description' => $request->description,
            );

            FineCollection::whereId($id)->update($input_data);
            return response()->json(['success' => 'Record Updated Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $libraryFine = FineCollection::findorfail($id);
        $libraryFine->delete();
        return response()->json(['success' => 'Record Deleted Successfully!']);
    }
}
