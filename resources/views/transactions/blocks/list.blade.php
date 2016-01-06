@foreach( $transactions as $transaction )
	<tr id="transaction_{{ $transaction->id }}">
		<td>{{ $transaction->id }}</td>
		<td>{{ $transaction->customer ? $transaction->customer->name : $transaction->customer_first_name . ' ' . $transaction->customer_last_name }}</td>
		<td>{{ $transaction->amazon_order_id }}</td>
		<td>{{ $transaction->recipient_email }}</td>
		<td>{{ $transaction->recipient_name }}</td>
		<td>
			<a href="{{ URL::route( 'transaction-transaction-items', [ $transaction->id ] ) }}" class="view-items">
				({{ $transaction->transactionItemsCount }}) View
			</a>
		</td>
		<td data-id="{{ $transaction->id }}" data-amazon-id="{{ $transaction->amazon_order_id }}" data-delete-url="{{ URL::route( 'delete-transaction', [ $transaction->id ] ) }}">
			<button class="btn btn-success edit-transaction">Edit</button>
            <button class="btn btn-danger delete-transaction">Delete</button>
		</td>
	</tr>
@endforeach