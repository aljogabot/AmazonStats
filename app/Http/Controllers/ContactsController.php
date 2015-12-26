<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
	protected $userRepository;
	protected $contactRepository;

    public function __construct( UserRepository $userRepository, ContactRepository $contactRepository )
    {
    	$this->userRepository 		= $userRepository;
    	$this->contactRepository 	= $contactRepository;
    }

    public function index()
    {
    	$contacts = $this->userRepository->getAllContacts();
    	return view( 'contacts.index', compact( 'contacts' ) );
    }

    public function search( Request $request )
    {
    	if( ! $request->has( 'email' ) )
    	{

    	}
    }


}
