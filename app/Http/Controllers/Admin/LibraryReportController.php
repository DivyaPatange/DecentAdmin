<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Classes;
use App\Models\Admin\Book;
use App\Models\Admin\Student;
use DB;
use App\Models\Admin\IssueBook;

class LibraryReportController extends Controller
{
    public function bookSummaryIndex()
    {
        $classes = Classes::where('status', 1)->get();
        $books = DB::table('books')
        ->select('id','author')
        ->groupBy('author')
        ->get();
        return view('admin.library-report.book-list', compact('classes', 'books'));
    }

    public function getLibraryBookList(Request $request)
    {
        $classes = Classes::where('id', $request->class_id)->first();
        if(!empty($classes)){
            $class_name = $classes->class_name;
        }
        else{
            $class_name = 'All';
        }
        $type = $request->type;
        $author = $request->author_name;
        $books1 = DB::table('books');
        if(isset($request->author_name) && !empty($request->author_name))
        {
            $books1 = $books1->where('author', $request->author_name); 
        }
        if(isset($request->class_id))
        {
            if($request->class_id != "All"){
                $books1 = $books1->where('class_id', $request->class_id);
            }
        }
        if(isset($request->type))
        {
            if($request->type != "All"){
                $books1 = $books1->where('type', $request->type);
            }
        }
        $books = $books1->orderBy('id', 'DESC')->get();
        $output = '';
        foreach($books as $key => $b)
        {
            $class = Classes::where('id', $b->class_id)->first();
            $issueBook = IssueBook::where('book_code', $b->book_code)->get()->sum('quantity');
            $stockQuantity = $b->quantity - $issueBook;
            $output .= '<tr>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.++$key.'</td>'.
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$b->book_code.'</td>'.
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$b->name.'</td>'.
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$b->type.'</td>'.
                '<td style="border: 1px solid black; border-collapse: collapse;">'; 
                if(!empty($class))
                {
                    $output .= $class->class_name;
                }
                $output .='</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$b->quantity.'</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$stockQuantity.'</td>'.
            '</tr>';
        }
        return response()->json(['output' => $output, 'author' => $author, 'type' => $type, 'class_name' => $class_name, 'success' => 'Data Found']);
    }

    public function bookReturnIndex()
    {
        return view('admin.library-report.book-return-list');
    }

    public function getReturnBookList(Request $request)
    {
        $date = '('.$request->date_from.') - ('.$request->date_to.')';
        $issueBook = IssueBook::whereBetween('return_date', [$request->date_from, $request->date_to])->get();
        $output = '';
        foreach($issueBook as $key => $i)
        {
            $book = Book::where('book_code', $i->book_code)->first();
            $student = Student::where('id', $i->student_id)->first();
            $output .= '<tr>'.
                '<td style="border: 1px solid black; border-collapse: collapse;">'.++$key.'</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$i->book_code.'</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">';
                if(!empty($book))
                {
                    $output .= $book->name;
                }
                $output .='</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">';
                if(!empty($student))
                {
                    $output .= $student->student_name;
                }
                $output .='</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">';
                if(!empty($student))
                {
                    $class = Classes::where('id', $student->class_id)->first();
                    if(!empty($class)){
                        $output .= $class->class_name;
                    }
                }
                $output .='</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">';
                if(!empty($student))
                {
                    $section = DB::table('sections')->where('id', $student->section_id)->first();
                    if(!empty($section)){
                        $output .= $section->section_name;
                    }
                }
                $output .='</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">';
                if(!empty($student))
                {
                    $academicYear = DB::table('academic_years')->where('id', $student->academic_id)->first();
                    if(!empty($academicYear)){
                        $output .= '('.$academicYear->from_academic_year.') - ('.$academicYear->to_academic_year.')';
                    }
                }
                $output .='</td>'.
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$i->issue_date.'</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$i->return_date.'</td>'.
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$i->quantity.'</td>'. 
            '</tr>';
        }
        return response()->json(['date' => $date, 'output' => $output, 'success' => 'Data Found']);
    }

    public function fineCollectionIndex()
    {
        return view('admin.library-report.fine-collection');
    }

    public function getFineCollectionList(Request $request)
    {
        $date = '('.$request->date_from.') - ('.$request->date_to.')';
        $fineCollection = DB::table('fine_collections')->whereBetween('collection_date', [$request->date_from, $request->date_to])->get();
        $output = '';
        foreach($fineCollection as $key => $f)
        {
            $student = Student::where('id', $i->student_id)->first();
            $output .='<tr>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.++$key.'</td>'.
                '<td style="border: 1px solid black; border-collapse: collapse;">';
                if(!empty($student))
                {
                    $output .= $student->student_name;
                }
                $output .='</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">';
                if(!empty($student))
                {
                    $class = Classes::where('id', $student->class_id)->first();
                    if(!empty($class)){
                        $output .= $class->class_name;
                    }
                }
                $output .='</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">';
                if(!empty($student))
                {
                    $section = DB::table('sections')->where('id', $student->section_id)->first();
                    if(!empty($section)){
                        $output .= $section->section_name;
                    }
                }
                $output .='</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">';
                if(!empty($student))
                {
                    $academicYear = DB::table('academic_years')->where('id', $student->academic_id)->first();
                    if(!empty($academicYear)){
                        $output .= '('.$academicYear->from_academic_year.') - ('.$academicYear->to_academic_year.')';
                    }
                }
                $output .='</td>'. 
                '<td style="border: 1px solid black; border-collapse: collapse;">'.$f->fine_amt.'</td>'.
            '</tr>';
        }
        return response()->json(['success' => 'Data Found', 'date' => $date, 'output' => $output]);
    }
}
