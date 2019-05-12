<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

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
        return view('dashboard.document.documents', [
            'user' => \Auth::user(),
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
        $fileName = $file->getClientOriginalName();

        Storage::disk('local')->putFileAs(
            'files/'.$fileName,
            $file,
            $fileName
        );


        error_log('here');

    }
}
