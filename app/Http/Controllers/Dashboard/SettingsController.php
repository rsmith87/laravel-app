<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserSettings;
use App\UserLocation;
use App\UserLawInfo;

class SettingsController extends Controller
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
            $this->timezones = config('vars.timezones');
            $this->states = config('vars.states');
            return $next($request);
        });
    }

    /**
     * Show the users settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', \Auth::id())->with('userLawInfo')->with('userSocialMedia')->with('userSettings')->with('userLocation')->first();
        
        return view('dashboard.user_settings', [
            'user' => \Auth::user(),
            'user_settings' => $user->userSettings ?? [],
            'user_law_info' => $user->userLawInfo ?? [],
            'user_location' => $user->userLocation ?? [],
            'timezones' => $this->timezones ?? [],
        ]);
    }

    /**
     * Posts location settings 
     * 
     * @return Redirect
     */

    public function settings_post(Request $request) {

        $data = $request->all();

        $validation = $request->validate([
           'address_1' => 'required',
           'city' => 'required',
           'state' => 'required',
           'zip' => 'required',
           'timezone' => 'nullable',
       ]);

       UserLocation::updateOrCreate([
           'user_id' => \Auth::id(),
       ],[
           'address_1' => $data['address_1'],
           'city' => $data['city'],
           'state' => $data['state'],
           'zip' => $data['zip'],
           'timezone' => $data['timezone'],           
       ]);

       return redirect()->back()->with('status', 'Location information updated successfully!');
    }

    /**
     * Posts location settings 
     * 
     * @return Redirect
     */
     public function location_post(Request $request) {

         $data = $request->all();

         $validation = $request->validate([
            'address_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'timezone' => 'nullable',
        ]);

        UserLocation::updateOrCreate([
            'user_id' => \Auth::id(),
        ],[
            'address_1' => $data['address_1'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip' => $data['zip'],
            'timezone' => $data['timezone'],           
        ]);

        return redirect()->back()->with('status', 'Location information updated successfully!');
     }


     /**
      * Posts legal information about a user
      * 
      * @return Redirect
      */

      public function legal_info_post(Request $request) {
          $data = $request->all();

          $validation = $request->validate([
            'state_of_bar' => 'required',
            'bar_number' => 'required',
          ]);

          $update = UserLawInfo::updateOrCreate([
            'user_id' => \Auth::id(),
          ],[
            'state_of_bar' => $data['state_of_bar'],
            'bar_number' => $data['bar_number'],
            'education' => $data['education'],
            'experience' => $data['experience'],
            'practice_areas' => $data['practice_areas'],
            'focus' => $data['focus'],
            'title' => $data['title'],
          ]);

          return redirect()->back()->with('status', 'Experience updated successfully');
      }
}
