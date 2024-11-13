@foreach($products as $product)
    <tr class="gradeX">
        <td>{{ $loop->iteration }}</td>
        <td>{{ $product->product_name }}</td>
        <td>{{ $product->product_price }}</td>
        <td>
            <img alt="NoImage" src="{{ asset('storage/product-image/'.$product->product_img) }}" width="50">
        </td>
        <td>{{ $product->category->category_name ?? 'N/A' }}</td>
        @if(session('role') === 'admin' || session('role') === 'M')
            <td>{{ $product->user->fullname ?? 'N/A' }}</td>
        @endif
        <td>
            <a class="btn btn-warning" href="{{ route('GetProducts', $product->id) }}">Edit</a>
            <a class="btn btn-danger" href="{{ route('DelProducts', $product->id) }}">Delete</a>
        </td>
    </tr>
@endforeach
