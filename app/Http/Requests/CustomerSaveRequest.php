<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerSaveRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = $this->route( 'id' );

        if( $id == 0 )
            return TRUE;

        return \Auth::user()->owns( \App\Customer::find( $id ) );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'email' => 'required|email|max:225'
        ];
    }
}
