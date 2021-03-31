<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Document;

class DocumentController extends Controller
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
        $documents = Document::all();
        if(request()->ajax()) {
            return datatables()->of($documents)
            ->addColumn('action', 'admin.document.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.document.index');
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
        $document = new Document();
        $document->admission_form = $request->admission_form;
        $document->document_name = $request->document_name;
        $document->save();
        return response()->json(['success' => 'Document Added Successfully']);
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

    public function getDocument(Request $request)
    {
        $document = Document::where('id', $request->bid)->first();
        if (!empty($document)) 
        {
            $data = array('id' =>$document->id,'admission_form' =>$document->admission_form,'document_name'=>$document->document_name
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateDocument(Request $request)
    {
        $document = Document::where('id', $request->id)->first();
        $input_data = array (
            'admission_form' => $request->admission_form,
            'document_name' => $request->document_name,
        );

        Document::whereId($document->id)->update($input_data);
        return response()->json(['success' => 'Document Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Document::findorfail($id);
        $document->delete();
        return response()->json(['success' => 'Document Deleted Successfully']);
    }
}
