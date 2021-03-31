<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin\IssueBook;
use App\Models\Admin\Book;
use App\Models\Admin\Student;

class IssueBookController extends Controller
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
        if(request()->ajax()) {
            $books1 = DB::table('issue_books');
            if(isset($request->code))
            {
                $books1 = $books1->where('book_code', $request->code); 
            }
            if(isset($request->regi_no))
            {
                $books1 = $books1->where('student_regi_no', $request->regi_no); 
            }
            if(isset($request->issue_date))
            {
                $books1 = $books1->where('issue_date', $request->issue_date); 
            }
            if(isset($request->return_date))
            {
                $books1 = $books1->where('return_date', $request->return_date); 
            }
            if(isset($request->status))
            {
                $books1 = $books1->where('status', $request->status); 
            }
            $issueBooks = $books1->orderBy('id', 'DESC')->get();
            return datatables()->of($issueBooks)
            ->addColumn('book_name', function($row){
                $bookName = Book::where('book_code', $row->book_code)->first();
                if(!empty($bookName))
                {
                    return $bookName->name;
                }
            })
            ->addColumn('student_name', function($row){
                $studentName = Student::where('id', $row->student_id)->first();
                if(!empty($studentName))
                {
                    return $studentName->student_name;
                }
            })
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Returned';
                else
                return 'Not Returned';
            })
            ->addColumn('action', 'admin.bookIssue.action')
            ->rawColumns(['action', 'status'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.bookIssue.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bookIssue.create');
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
        $book = Book::where('book_code', $request->code)->first();
        $issuedBook = IssueBook::where('book_code', $request->code)->get()->sum('quantity');
        if(empty($student))
        {
            return response()->json(['error' => 'Student Regi. No. Not Found']);
        }
        if(empty($book))
        {
            return response()->json(['error' => 'ISBN No./Code Not Found']);
        }
        else{
            $outOfBook = $book->quantity - $issuedBook;
            if($outOfBook < $request->quantity)
            {
                return response()->json(['error' => 'Book is not available in stock.']);
            }
            else{
                $issueBook = new IssueBook();
                $issueBook->student_id = $student->id;
                $issueBook->student_regi_no = $request->regi_no;
                $issueBook->book_code = $request->code;
                $issueBook->issue_date = $request->issue_date;
                $issueBook->return_date = $request->return_date;
                $issueBook->quantity = $request->quantity;
                $issueBook->save();
                return response()->json(['success' => 'Book Issue Successfully!']);
            }
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
        $issueBook = IssueBook::findorfail($id);
        return view('admin.bookIssue.edit', compact('issueBook'));
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
        $student = Student::where('regi_no', $request->regi_no)->first();
        $book = Book::where('book_code', $request->code)->first();
        if(empty($student))
        {
            return response()->json(['error' => 'Student Regi. No. Not Found']);
        }
        if(empty($book))
        {
            return response()->json(['error' => 'ISBN No./Code Not Found']);
        }
        else{
            $issueBook = IssueBook::where('id', $id)->first();
            $input_data = array (
                'student_id' => $student->id,
                'book_code' => $request->code,
                'student_regi_no' => $request->regi_no,
                'issue_date' => $request->issue_date,
                'return_date' => $request->return_date,
                'quantity' => $request->quantity,
            );

            IssueBook::whereId($issueBook->id)->update($input_data);
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
        $issueBook = IssueBook::findorfail($id);
        $issueBook->delete();
        return response()->json(['success' => 'Record Deleted Successfully']);
    }

    public function status($id)
    {
        $issueBook = IssueBook::findorfail($id);
        if($issueBook->status == 0)
        {
            $issueBook->status = 1;
        }
        else{
            $issueBook->status = 0;
        }
        $issueBook->save();
        return response()->json(['success' => 'Status Changed Successfully!']);
    }
}
