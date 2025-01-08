@extends('template')

@section('content')

<div class="card p-4" style="width: 300px;margin: auto;margin-top: 100px;">

    <div class="card-header">
        <h5>Create Product</h4>
    </div>

    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <b class="" role="alert">{{ $errors->first() }}</b>
            </div>
        @endif
        <form action="{{ route('post_product') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
            <input class="form-control" name="name" type="text" placeholder="Prodcut Name" required>
            </div>

            <div class="mb-3">
            <input class="form-control" name="price" type="text" placeholder="Price" required>
            </div>

            <div class="mb-3">
            <input class="form-control" name="quantityAvailable" type="number" placeholder="Quantity Available" required>
            </div>

            <button class="btn btn-sm btn-primary" type="submit">Create</button> 
        </form>
    </div>

</div>

@endsection