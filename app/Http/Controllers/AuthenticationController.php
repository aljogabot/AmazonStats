<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
{
    protected $userRepository;

    public function __construct( UserRepository $userRepository )
    {
    	$this->userRepository = $userRepository;
    }

    public function authenticate( LoginRequest $request )
    {
    	if( ! Auth::attempt( $request->only( 'email', 'password' ) ) )
        {
            return $this->json->error( 'Credentials Not Authorized ...' );
        }

        return $this->set->redirect( 'redirect', URL::route( 'customers' ) )
                        ->success( 'Logged In Successfully ...' );
    }

    public function logout()
    {
    	Auth::logout();
        return redirect( URL::route( 'home' ) );
    }
}
