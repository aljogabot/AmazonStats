@foreach( $customers as $customer )
	<tr id="customer_{{ $customer->id }}">
		<td>{{ $customer->id }}</td>
		<td>{{ $customer->name }}</td>
		<td>{{ $customer->email }}</td>
		<td>
			<a href="{{ URL::route( 'customer-transactions', [ $customer->id ] ) }}" class="view-transactions">
				({{ $customer->transactionsCount }}) Transaction(s)
			</a>
		</td>
		<td data-id="{{ $customer->id }}" data-name="{{ $customer->name }}" data-delete-url="{{ URL::route( 'delete-customer', [ $customer->id ] ) }}">
			<button class="btn btn-success edit-customer">Edit</button>
            <button class="btn btn-danger delete-customer">Delete</button>
            <a href="{{ URL::route( 'customer-transactions', [ $customer->id ] ) }}" class="view-transactions btn btn-info">
				View Transactions
			</a>
		</td>
	</tr>
@endforeach