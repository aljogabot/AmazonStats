<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use URL, Auth;

use AmazonStats\Handlers\ResponseHandlers\JsonResponse;

use AmazonStats\Repositories\UserRepository;

use App\Http\Requests\LoginRequest, App\Http\Requests\RegisterRequest;

class AuthenticationController extends Controller
{
    protected $userRepository;

    public function __construct( JsonResponse $json, UserRepository $userRepository )
    {
        $this->middleware( 'guest', [ 'except' => 'logout' ] );
    	$this->userRepository = $userRepository;
        $this->json = $json;
    }

    /**
     * Home Page ...
     * @return Response ....
     */
    public function index()
    {
        return view( 'authentication.layout' );
    }

    public function login( LoginRequest $request )
    {
    	if( ! Auth::attempt( $request->only( 'email', 'password' ), $request->has( 'remember_me' ) ) )
        {
            return $this->json->error( 'Credentials Not Authorized ...' );
        }

        return $this->json->set( 'redirect', URL::route( 'customers' ) )
                        ->success( 'Logged In Successfully ...' );
    }

    public function register( RegisterRequest $request )
    {
        if( ! $this->userRepository->register( $request->all() ) )
        {
            return $this->json->error( 'Registration Error ... Please Try Again ...' );
        }

        // Login the User ...
        Auth::attempt( $request->only( 'email', 'password' ) );

        // 
        return $this->json->success('Registration Successfull ...');
    }

    public function logout()
    {
    	Auth::logout();
        \Session::flush();
        return redirect( \URL::route( 'home' ) );
    }
}
