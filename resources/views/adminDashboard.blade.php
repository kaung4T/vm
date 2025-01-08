@extends('template')

@section('content')

    
    <div class="card" style="width: 700px;margin: auto;margin-top: 100px;">
        <div class="card-body">
            <form action="{{ route('logout') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <button class="btn btn-sm btn-secondary" type="submit">Logout</button>
            </form>

            <div class="mt-5 d-flex">
                <div class="admin_left">
                    <ul>
                        <li><a href="{{ route('adminDashboard') }}">Products</a></li>
                        <li><a href="{{ route('adminDashboardUser') }}">Users</a></li>
                        <li><a href="{{ route('adminDashboardTransaction') }}">Transactions</a></li>
                    </ul>
                </div>
                <div class="admin_right">
                    @if (!$products->isEmpty())
                        <a href="{{ route('post_ui') }}">Create</a>
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Proudcts</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity Available</th>
                            <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        @foreach ($products as $product)
                        <tbody>
                            <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantityAvailable }}</td>
                            <td>
                                <a href="{{ route('put_ui', $product->id) }}">Update</a>
                                <form action="{{ route('delete_product', $product->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <button class="btn btn-sm btn-danger mt-2" type="submit">Delete</button>
                                </form>
                            </td>
                            </tr>
                            <tr>
                        </tbody>
                        @endforeach
                        </table>
                    @else
                        <a href="{{ route('post_ui') }}">Create</a>
                        <p>No products yet!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection