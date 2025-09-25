<?php

namespace App\Http\Controllers;

use Auth;
use Socialite;
use App\User;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function redirect(Request $request, $provider)
    {
    	$request->session()->forget('user_role');
     	return Socialite::driver($provider)->redirect();
    }

    public function Callback(Request $request, $provider)
	{
		try{
			$role = $request->session()->get('user_role');
			$userSocial =   Socialite::driver($provider)->stateless()->user();
	        $users      =   User::where(['email' => $userSocial->getEmail()])->first();
	        if(!$users && $role) {
	        	if($role == 1) {
	        		$user_type = 'owner';
	        	}else if($role == 2) {
	        		$user_type = 'builder';
	        	}else if($role == 3) {
	        		$user_type = 'agent';
	        	}
	        	$user = User::create(
	        		[
	        			'role'           => $user_type,
	        			'firstname'      => $userSocial->getName(), 
	        			'email'          => $userSocial->getEmail(),
	        			'password'       => \Hash::make(rand(10000, 99999)),
	        			'provider'       => $provider, 
	        			'provider_id'    => $userSocial->getId()
	        		]
	        	);
	        	Auth::login($user);
	            if(Auth::user()->role == 'owner') {
	            	return redirect()->route('user.dashboard');
	            }else if(Auth::user()->role == 'builder') {
	            	return redirect()->route('builder.builderDashboard');
	            }else if(Auth::user()->role == 'agent') {
	            	return redirect()->route('agent.agentDashboard');
	            }
	        }
			if($users && $role == null){
	            Auth::login($users);
	            if(Auth::user()->role == 'owner') {
	            	return redirect()->route('user.dashboard');
	            }else if(Auth::user()->role == 'builder') {
	            	return redirect()->route('builder.builderDashboard');
	            }else if(Auth::user()->role == 'agent') {
	            	return redirect()->route('agent.agentDashboard');
	            }
	        }else{
				return redirect('/'.'Lucknow')->with('error', 'Accont Does Not Exist');
			}
		}catch(\Exception $e) {
			return redirect('/'.'Lucknow')->with('error', $e->getMessage());
		}
	    
	}

	public function redirectSignup(Request $request, $provider)
    {
    	$request->session()->forget('user_role');
     	$request->session()->put('user_role', $request->input('role'));
     	return Socialite::driver($provider)->redirect();
    }

    public function googleCallback(Request $request, $provider) {
    	try{
			$role = $request->session()->get('user_role');
			$userSocial =   Socialite::driver($provider)->stateless()->user();
	        $users      =   User::where(['email' => $userSocial->getEmail()])->first();
	        if(!$users && $role) {
	        	if($role == 1) {
	        		$user_type = 'owner';
	        	}else if($role == 2) {
	        		$user_type = 'builder';
	        	}else if($role == 3) {
	        		$user_type = 'agent';
	        	}
	        	$user = User::create(
	        		[
	        			'role'           => $user_type,
	        			'firstname'      => $userSocial->getName(), 
	        			'email'          => $userSocial->getEmail(),
	        			'password'       => \Hash::make(rand(10000, 99999)),
	        			'provider'       => $provider, 
	        			'provider_id'    => $userSocial->getId()
	        		]
	        	);
	        	Auth::login($user);
	            if(Auth::user()->role == 'owner') {
	            	return redirect()->route('user.dashboard');
	            }else if(Auth::user()->role == 'builder') {
	            	return redirect()->route('builder.builderDashboard');
	            }else if(Auth::user()->role == 'agent') {
	            	return redirect()->route('agent.agentDashboard');
	            }
	        }
			if($users && $role == null){
	            Auth::login($users);
	            if(Auth::user()->role == 'owner') {
	            	return redirect()->route('user.dashboard');
	            }else if(Auth::user()->role == 'builder') {
	            	return redirect()->route('builder.builderDashboard');
	            }else if(Auth::user()->role == 'agent') {
	            	return redirect()->route('agent.agentDashboard');
	            }
	        }else{
				return redirect('/'.'Lucknow')->with('error', 'Accont Does Not Exist');
			}
		}catch(\Exception $e) {
			return redirect('/'.'Lucknow')->with('error', $e->getMessage());
		}
    }
}
