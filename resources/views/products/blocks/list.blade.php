@foreach( $products as $product )
	<tr id="product_{{ $product->id }}">
		<td>{{ $product->id }}</td>
		<td>{{ $product->sku }}</td>
		<td>{{ $product->name }}</td>
		<td>{{ $product->price }}</td>
		<td data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-delete-url="{{ URL::route( 'delete-product', [ $product->id ] ) }}">
			<button class="btn btn-success edit-product">Edit</button>
            <button class="btn btn-danger delete-product">Delete</button>
		</td>
	</tr>
@endforeach