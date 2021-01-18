<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\License;

use Carbon\Carbon;
use Auth;

class LicenseController extends Controller
{
	public function __construct()
	{
        $this->middleware('auth', ['except' => ['verify_license']]);
	}

    public function index()
    {
    	$licenses = License::all();

    	return view('license.index')
    			->with('licenses', $licenses);
    }

    public function create()
    {
    	return view('license.create');
    }

    public function store(Request $request)
    {
    	$license = new License;
        $license->app_name = $request->app_name;
        $license->app_url = $request->app_url;
    	$license->license_key = $this->keygen();
    	$license->registered_name = $request->name;
    	$license->registered_email = $request->email;
    	$license->registered_date = Carbon::now();
    	$license->created_by = Auth::user()->name;
    	$license->updated_by = Auth::user()->name;
    	$license->is_active = false;
    	$license->save();

    	return redirect()->route('license');
    }

    public function update_activation($id)
    {
    	$license = License::find($id);
    	$license->is_active = $license->is_active ? false : true;
    	$license->save();
    }

    public function destroy($id)
    {
    	$license = License::find($id);
    	$license->delete();
    }

    public function verify_license(Request $request)
    {
    	$license = License::where('license_key', $request->license)->first();

    	return response()->json([
		    'name' => $license->registered_name,
		    'email' => $license->registered_email,
		    'is_active' => $license->is_active,
		]);
    }

    public static function keygen()
    {
    	$key = md5(time());
		$new_key = '';
		
		for($i=1; $i <= 25; $i ++ ){
		    $new_key .= $key[$i];
			if ( $i%5==0 && $i != 25) {
				$new_key.='-';
			}
		}

		return strtoupper($new_key);
    }
}
