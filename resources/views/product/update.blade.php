@extends('template')

@section('content')

<div class="card p-4" style="width: 300px;margin: auto;margin-top: 100px;">

    <div class="card-header">
        <h5>Update Product</h4>
    </div>

    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <b class="" role="alert">{{ $errors->first() }}</b>
            </div>
        @endif
        <form action="{{ route('put_product', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
            <input class="form-control" name="name" type="text" placeholder="" value="{{ $product->name }}" required>
            </div>

            <div class="mb-3">
            <input class="form-control" name="price" type="text" placeholder="" value="{{ $product->price }}" required>
            </div>

            <div class="mb-3">
            <input class="form-control" name="quantityAvailable" type="number" placeholder="" value="{{ $product->quantityAvailable }}" required>
            </div>

            <button class="btn btn-sm btn-primary" type="submit">Update</button> 
        </form>
    </div>

</div>

@endsection