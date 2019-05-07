<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\UserSettings;
use App\Firm;
use App\FirmLocation;
use App\FirmBilling;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class FirmController extends Controller
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
        if(!empty($this->user_settings->firm_id)) {
            $firm = Firm::where('id', $this->user_settings->firm_id)->with('firmLocation')->with('firmBilling')->first();
        }
        return view('dashboard.firm', [
            'firm' => $firm ?? null,
        ]);
    }

    /**
     * Post the edit firm form to update firm details.
     * 
     * @return view
     */
    public function post(Request $request)
    {
        $data = $request->all();

        $validation = $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ]);

        //create firm
        $firm = Firm::updateOrCreate([
            'id' => $this->user_settings->firm_id ?? null,
        ],[
            'uuid' => (string) Str::uuid(),
            'name' => $data['name'],
            'phone' => $data['phone'],
            'fax' => $data['fax']
        ]);

        //update firm location table
        $firm_location = FirmLocation::updateOrCreate([
            'firm_id' => $firm->id,
        ], [
            'address_1' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip' => $data['zip'],
        ]);

        //update user settings table
        $firm_update_user_settings = UserSettings::updateOrCreate([
            'user_id' => \Auth::id()
        ],[
            'uuid' => (string) Str::uuid(),
            'firm_id' => $firm->id,
        ]);

        return redirect()->back()->with('status', 'Firm updated successfully');

    }

    public function stripe_account_create(Request $request)
    {
        if(empty($this->user_settings->firm_id)){
            return redirect('/firm#profile')->withErrors('You must complete your firm setup before you can complete the Stripe setup for your firm.');
        }

        $action = 'https://lgk.rob/firm/stripe/redirect';
        return redirect()->away('https://connect.stripe.com/express/oauth/authorize?redirect_uri='. $action . '&client_id=' . env('STRIPE_CLIENT_ID') . '&state=' . csrf_token());
    }

    public function stripe_return(Request $request)
    {

        if(empty($this->user_settings->firm_id)){
            return redirect('/firm')->withErrors('You must complete your firm setup before you can complete the Stripe setup for your firm.');
        }

        //make guzzle call to get account_id for the firm
        $client = new Client(); //GuzzleHttp\Client
        $response = $client->post('https://connect.stripe.com/oauth/token', [
            'form_params' => [
                'client_secret' => env('STRIPE_SECRET'),
                'code' => $_REQUEST['code'],
                'grant_type' => 'authorization_code',
            ]
        ]);

        if ($response) {
            $data = json_decode($response->getBody()->getContents(), true);

            
            $firm = Firm::where('id', $this->user_settings->firm_id)->first();
            

            $fs = FirmBilling::updateOrCreate([
                'firm_id' => $firm->id,
            ], [
                'firm_stripe_token' => $data['stripe_user_id'],
                'user_id' => \Auth::id(),
            ]);
        } else {
            return redirct()->back()->withErrors('We were unable to recieve a response from Stripe.  Please try again.');
        }

        
        return redirect('/firm')->with('status', 'Your Stripe account is created and has been connected!');
    }

}
