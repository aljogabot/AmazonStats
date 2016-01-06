@foreach( $transactionItems as $transactionItem )
	<tr id="transaction_{{ $transactionItem->id }}">
		<td>{{ $transactionItem->id }}</td>
		<td>{{ $transactionItem->transaction_amazon_id }}</td>
		<td>{{ $transactionItem->customer_name }}</td>
		<td>{{ $transactionItem->amazon_order_item_id }}</td>
		<td>{{ $transactionItem->amazon_product_name }}</td>
		<td>{{ $transactionItem->quantity }}</td>
		<td>${{ $transactionItem->payout }}</td>
		<td data-id="{{ $transactionItem->id }}" data-amazon-product-name="{{ $transactionItem->amazon_product_name }}" data-delete-url="{{ URL::route( 'delete-transaction-item', [ $transactionItem->id ] ) }}">
			<button class="btn btn-success edit-transaction-item">Edit</button>
            <button class="btn btn-danger delete-transaction-item">Delete</button>
		</td>
	</tr>
@endforeach