@extends('template')

@section('content')

    
    <div style="width: 700px;margin: auto;margin-top: 100px;">
        <div class="p-1 pb-3">
            <form action="{{ route('logout') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <button class="btn btn-sm btn-secondary" type="submit">Logout</button>
            </form>
            <div class="dropdown mt-3">
                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sorting by price
                </button>
                <div class="dropdown-menu bg-secondary" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item text-light bg-secondary" href="{{ route('productSorting', '0') }}">Lowest</a>
                    <a class="dropdown-item text-light bg-secondary" href="{{ route('productSorting', '1') }}">Highest</a>
                </div>
            </div>
            @if(session()->has('success'))
                <div class="alert alert-success mt-3 mb-1">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
                    @if (!$products->isEmpty())
                        <div class="d-flex">
                            @foreach ($products as $product)
                            <a class="card customer_product" href="{{ route('singleUserProduct', $product->id) }}">
                                <div class="card-body">
                                    <ul>
                                        <li>ProductName: <span class="text-muted"> {{ $product->name }} </span></li>
                                        <li>Price: <span class="text-muted"> {{ $product->price }} </span></li>
                                        <li>QuantityAvailable: <span class="text-muted"> {{ $product->quantityAvailable }} </span></li>
                                    </ul>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $products->links() }}
                        </div>
                    @else
                    <div class="card-body">
                        <p>No products yet!</p>
                    </div>
                    @endif
    </div>


@endsection