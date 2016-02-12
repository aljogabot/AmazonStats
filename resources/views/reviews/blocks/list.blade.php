@foreach( $reviews as $review )
	<tr id="review_{{ $review->id }}">
		<td>{{ $review->id }}</td>
		<td>{{ $review->customer->name }}</td>
		<td>{{ $review->customer->buyer_id }}</td>
		<td>{{ $review->product->name }}</td>
		<td>{{ $review->link }}</td>
		<td>{{ $review->notes }}</td>
		<td data-id="{{ $review->id }}" data-delete-url="{{ URL::route( 'delete-review', [ $review->id ] ) }}">
			<button class="btn btn-success edit-review">Edit</button>
            <button class="btn btn-danger delete-review">Delete</button>
		</td>
	</tr>
@endforeach