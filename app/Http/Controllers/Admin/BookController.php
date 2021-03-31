<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Classes;
use App\Models\Admin\Book;
use App\Models\Admin\IssueBook;
use DB;

class BookController extends Controller
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
            $books1 = DB::table('books');
            if(isset($request->code) && !empty($request->code))
            {
                $books1 = $books1->where('book_code', $request->code); 
            }
            if(isset($request->book_name))
            {
                $books1 = $books1->where('name', 'LIKE', $request->book_name.'%'); 
            }
            if(isset($request->author_name))
            {
                $books1 = $books1->where('author', 'LIKE', $request->author_name.'%'); 
            }
            if(isset($request->type))
            {
                if($request->type != "All"){
                    $books1 = $books1->where('type', $request->type); 
                }
            }
            if(isset($request->class_id))
            {
                $books1 = $books1->where('class_id', $request->class_id);
            }
            $books = $books1->orderBy('id', 'DESC')->get();
            return datatables()->of($books)
            ->addColumn('class_id', function($row){
                $class = Classes::where('id', $row->class_id)->first();
                if(!empty($class))
                {
                    return $class->class_name;
                }
            })
            ->addColumn('stock_quantity', function($row){
                $issueBook = IssueBook::where('book_code', $row->book_code)->get()->sum('quantity');
                $stockQuantity = $row->quantity - $issueBook;
                return $stockQuantity;
            })
            ->addColumn('action', 'admin.books.action')
            ->rawColumns(['action', 'stock_quantity'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.books.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::where('status', 1)->get();
        return view('admin.books.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkBook = Book::where('book_code', $request->code)->first();
        if(!empty($checkBook))
        {
            return response()->json(['error' => 'This ISBN No. is already taken.']);
        }
        else{
            $book = new Book();
            $book->book_code = $request->code;
            $book->name = $request->book_name;
            $book->author = $request->author_name;
            $book->type = $request->type;
            $book->class_id = $request->class_id;
            $book->quantity = $request->quantity;
            $book->rack_no = $request->rack_no;
            $book->save();
            return response()->json(['success' => 'Book Added Successfully']);
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
        $classes = Classes::where('status', 1)->get();
        $book = Book::findorfail($id);
        return view('admin.books.edit', compact('book', 'classes'));
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
        $book = Book::where('id', $request->id)->first();
        $input_data = array (
            'book_code' => $request->code,
            'name' => $request->book_name,
            'author' => $request->author_name,
            'type' => $request->type,
            'class_id' => $request->class_id,
            'quantity' => $request->quantity,
            'rack_no' => $request->rack_no,
        );

        Book::whereId($book->id)->update($input_data);
        return response()->json(['success' => 'Book Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findorfail($id);
        $book->delete();
        return response()->json(['success' => 'Book Deleted Successfully']);
    }
}
