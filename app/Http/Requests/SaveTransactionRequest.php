<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaveTransactionRequest extends Request
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

        $transaction = \App\Transaction::find( $id );

        if( ! $transaction )
            return TRUE;

        return \Auth::user()->hasCustomer( $transaction->customer );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'required',
            'amazon_order_id' => 'required',
            'recipient_name' => 'required',
            'recipient_email' => 'required'
        ];
    }
}
