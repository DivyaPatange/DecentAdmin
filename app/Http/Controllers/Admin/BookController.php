<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Classes;
use App\Models\Admin\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classes = Classes::where('status', 1)->get();
        $books = Book::select('*');
        if(request()->ajax()) {
            return datatables()->of($books)
            ->addColumn('class_id', function($row){
                $class = Classes::where('id', $row->class_id)->first();
                if(!empty($class))
                {
                    return $class->class_name;
                }
            })
            ->filter(function ($instance) use ($request) {
                if ($request->get('code')) {
                    $instance->where('book_code', $request->get('code'));
                }
            })
            ->filter(function ($instance) use ($request) {
                if ($request->get('book_name')) {
                    $instance->where('name', $request->get('book_name'));
                }
            })
            ->filter(function ($instance) use ($request) {
                if ($request->get('author_name')) {
                    $instance->where('author', $request->get('author_name'));
                }
            })
            ->filter(function ($instance) use ($request) {
                if ($request->get('type') != "All") {
                    $instance->where('type', $request->get('type'));
                }
            })
            ->filter(function ($instance) use ($request) {
                if ($request->get('class_id')) {
                    $instance->where('class_id', $request->get('class_id'));
                }
            })
            ->addColumn('action', 'admin.academic-year.action')
            ->rawColumns(['action'])
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
}
