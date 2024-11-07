

@foreach($products as $product)  <!-- **Changed 'product' to 'products' to match controller -->

<tr class="gradeX">
    <td>{{ $index++ }}</td>
    <td>{{ $product->product_name }}</td>
    <td>{{ $product->product_price }}</td>
    <td>

        <img alt="NoImage" src="{{ asset('storage/product-image/'.$product->product_img) }}" width="50">
        {{--                                    <img alt="NoImage" src="{{ storage_path('public/product-images/'$product->product_img) }}" width="50">--}}
    </td>
    <td>{{ $product->category->category_name}}</td>
    @if(session('role')=== 'admin' || session('role')==='M')
        <td>{{ $product->user->fullname}}</td>
    @endif
{{--    @if(session('role')==='admin')--}}
{{--        <td>{{ $product->m_id->fullname ?? 'N/A' }}</td>--}}
{{--    @endif--}}
    <td>
        <a class="btn btn-warning" href="{{('edit-product')}}/{{$product->id}}">Edit</a> &nbsp;
        <a class="btn btn-danger" href="{{('del-product')}}/{{$product->id}}">Delete</a>
    </td>
</tr>
@endforeach
