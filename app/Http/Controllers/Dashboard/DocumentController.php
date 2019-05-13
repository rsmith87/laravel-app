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
    public function post(Request $request)
    {
        $data = $request->all();
        $file = $request->file('file');
        //$tempFile = $data['file']['tmp_name'];
        $file_name = $file->getClientOriginalName();
        $file_path = $file->getPathName();
        $file_extension = $file->clientExtension();
        
        $storage_success = Storage::disk('local')->putFileAs(
            \Auth::id().'/files',
            $file,
            $file_name
        );

        /*Create models for this file now*/
        Document::create([
            'uuid' => (string) Str::uuid(),
            'name' => $file_name,
            'type' => $file_extension,
            
            'path' => $storage_success,
            'user_id' => \Auth::id(),
        ]);


        if($storage_success) {
            return response()->json('success', 200);
        } else {
            return response()->json('error', 400);
        }

    }

    /*public function post_folder(Request $request)
    {
        $data = $request->all();
        $folder_name = $data['name'];

        Folder::create([
            'uuid' => (string) Str::uuid(),
            'name' => $data['name'],
            'user_id' => \Auth::id(),
        ]);

        return redirect()->back();
    }*/
}
