@extends('template')

@section('content')

    
    <div style="width: 500px;margin: auto;margin-top: 100px;">
        <div class="p-1 pb-3">
            <form action="{{ route('logout') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <button class="btn btn-sm btn-secondary" type="submit">Logout</button>
            </form>
        </div>
                    @if ($product)
                        <div class="card customer_product">
                            <div class="card-body">
                                @if($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        <b class="" role="alert">{{ $errors->first() }}</b>
                                    </div>
                                @endif
                                <ul>
                                    <li>ProductName: <span class="text-muted"> {{ $product->name }} </span></li>
                                    <li>Price: <span class="text-muted"> {{ $product->price }} </span></li>
                                    <li>QuantityAvailable: <span class="text-muted"> {{ $product->quantityAvailable }} </span></li>
                                </ul>

                                <form action="{{ route('userPurchasingProcess', $product->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" name="userId" value="auth()->user()->id" hidden>
                                    <button class="btn btn-sm btn-primary" type="submit">Purchase</button>
                                </form>
                            </div>
                        </div>
                    @else
                    <div class="card-body">
                        <p>No product found!</p>
                    </div>
                    @endif
    </div>


@endsection