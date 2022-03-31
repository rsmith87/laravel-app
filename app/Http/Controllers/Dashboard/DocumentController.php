<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Document;
use App\Folder;

class DocumentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the users documents
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::where('user_id', \Auth::id())->get();

        return view('dashboard.document.documents', [
            'user' => \Auth::user(),
            'documents' => $documents,
        ]);
    }

    /**
     * Post the user document
     *
     * @return \Illuminate\Http\Response
     */
    public function post_file(Request $request)
    {
        $data = $request->all();
        $file = $request->file('file');
        //$tempFile = $data['file']['tmp_name'];
        $file_name = $file->getClientOriginalName();
        $file_path = $file->getPathName();
        $file_extension = $file->clientExtension();
        
        $path = 'users/'.\Auth::id().'/files';
        $dest_path = base_path('public/users/'.\Auth::id().'/files');
        $storage_success = $file->move($dest_path, $file->getClientOriginalName());

        /*Create models for this file now*/
        Document::create([
            'uuid' => (string) Str::uuid(),
            'name' => $file_name,
            'type' => $file_extension,
            'path' => $path.'/'.$file->getClientOriginalName(),
            'user_id' => \Auth::id(),
        ]);


        if($storage_success) {
            return response()->json('success', 200);
        } else {
            return response()->json('error', 400);
        }

    }

    /**
     * Posts a folder with name
     *
     * @param Request $request
     * @return void
     */
    public function post_folder(Request $request)
    {
        $data = $request->all();
        $folder_name = $data['folder_name'];

        Document::create([
            'uuid' => (string) Str::uuid(),
            'name' => $folder_name,
            'is_folder' => 1,
            'user_id' => \Auth::id(),
            'path' => null,
            'type' => 'folder'
        ]);

        return redirect()->back();
    }

    /**
     * Posts a WYSIWYG Document
     *
     * @param Request $request
     * @return void
     */
    public function post_wysiwyg_document(Request $request)
    {
        $data = $request->all();
        $tinymce_data = $data['tinymce_data'];

        /*Create models for this file now*/
        Document::create([
            'uuid' => (string) Str::uuid(),
            'name' => $data['document_name'],
            'type' => 'tinymce',
            'path' => 'db',
            'data' => $tinymce_data,
            'user_id' => \Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Your document has been created');
    }

    /**
     * View File for ajax
     *
     * @param Request $request
     * @return void
     */
    public function view_file($uuid = null) 
    {
        $data = $uuid;

        $document = Document::where('uuid', $uuid)->first();

        return $document->toArray();
    }
}
