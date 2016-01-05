<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TransactionItemSaveRequest extends Request
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

        $transactionItem = \App\TransactionItem::find( $id );

        if( ! $transactionItem )
            return TRUE;

        return \Auth::user()->owns( $transactionItem->transaction->customer );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'transaction_id' => 'required',
            'amazon_product_id' => 'required',
            'quantity' => 'required|numeric',
            'payout' => 'required'
        ];
    }
}
