<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\UserSettings;
use App\LegalCase;
use App\LegalCaseOpposingCouncel;
use App\Client;
use App\ClientContactInformation;
use App\ClientLocation;
use Carbon\Carbon;

class LegalCaseController extends Controller
{
/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user_settings = UserSettings::where('user_id', \Auth::id())->first();
            return $next($request);
        });
    }

    /**
     * Return the index firm view.
     *
     * @return view
     */
    public function index()
    {
        $legal_cases = LegalCase::where('user_id', \Auth::id())->get();

        return view('dashboard.case.legal_case', [
            'legal_cases' => $legal_cases ?? null,
        ]);
    }

    /**
     * Posts a single case 
     * 
     * @return redirect
     */
    public function post(Request $request)
    {
        $validation = $request->validate([
            'case_name' => 'required',
            'open_date' => 'required',
        ]);

        $data = $request->all();

        $date_format_fix = Carbon::parse($data['open_date'])->format('Y-m-d');
        
        $legal_case = LegalCase::create([
            'case_uuid' => (string) Str::uuid(),
            'name' => $data['case_name'],
            'open_date' => $date_format_fix,
            'user_id' => \Auth::id(),
        ]);

        return redirect('/cases/'.$legal_case->case_uuid)->with('status', 'Case '. $legal_case->name . ' created');
    }

    /**
     * Returns data about a single case
     * 
     * @return view
     */
    public function single(Request $request)
    {
        $uri = $request->path();
        $explode = explode('/', $uri);
        
        if(!$explode[1]){
            return redirect()->back()->withErrors(['No URI']);
        }
        $legal_case = LegalCase::where('case_uuid', $explode[1])->with(['legalCaseBilling', 'legalCaseInvoice', 'legalCaseLocation', 'legalCaseOpposingCouncel', 'client.clientContactInfo'])->first();

        return view('dashboard.case.legal_case_single', [
            'legal_case' => $legal_case,
        ]);
    }

    /**
     * Posts client data on case page
     * 
     * @return redirect
     */
    public function post_client(Request $request)
    {
        $validation = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
        ]);    
        
        $data = $request->all();

        $legal_case = LegalCase::where('case_uuid', $data['case_uuid'])->first();

        $client = Client::create([
            'uuid' => (string) Str::uuid(),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'company' => $data['company'],
            'company_title' => $data['company_title'],
            'legal_case_id' => $legal_case->id,
            'firm_id' => $this->user_settings->firm_id,
            'owner_user_id' => \Auth::id(),
        ]);

        $client_contact = ClientContactInformation::create([
            'client_id' => $client->id,
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address_1' => $data['address_1'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip' => $data['zip'],
        ]);

        return redirect('/cases/'.$legal_case->case_uuid.'#client-information')->with('status', 'Client '. $client->first_name . " " . $client->last_name . " created");
    }

    /**
     * Posts client location data
     * 
     * @return redirect
     */
    public function post_client_location(Request $request)
    {
        $validation = $request->validate([
            'address_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'client_uuid' => 'required',
        ]);

        $data = $request->all();

        $client = Client::where('uuid', $data['client_uuid'])->first();

      
        return redirect('/cases/'.$legal_case->case_uuid.'#client-information')->with('status', 'Client address updated.');
    }

        /**
     * Posts client location data
     * 
     * @return redirect
     */
    public function post_opposing_councel(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'case_uuid' => 'required',
        ]);

        $data = $request->all();

        $legal_case = LegalCase::where('case_uuid', $data['case_uuid'])->first();

        $client_contact = LegalCaseOpposingCouncel::create([
            'case_id' => $legal_case->id,
            'opposing_councel_name' => $data['name'],
            'opposing_councel_phone' => $data['phone'],
            'opposing_councel_fax' => $data['fax'],
            'opposing_councel_address' => $data['address_1'],
            'opposing_councel_city' => $data['city'],
            'opposing_councel_state' => $data['state'],
            'opposing_councel_zip' => $data['zip'],
        ]);

        return redirect()->back()->with('status', 'Opposing councel added.');
    }
}
