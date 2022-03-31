<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Client;
use App\Http\Controllers\Controller;

class ClientController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::where('owner_user_id', \Auth::id())->get();
        return view('dashboard.client.client', [
            'user' => \Auth::user(),
            'clients' => $clients,
        ]);
    }    

    /**
     * Show the current client
     * 
     * @return \Illuminate\Http\Response
     */
    public function single(Request $request)
    {
        $uri = $request->path();
        $explode = explode('/', $uri);
        
        if(!$explode[1]){
            return redirect()->back()->withErrors(['No URI']);
        }
        $client = Client::where('uuid', $explode[1])->with('clientContactInfo')->first();

        return view('dashboard.client.single', [
            'client' => $client,
        ]);       
    }
}
