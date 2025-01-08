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
                    @if (!$users->isEmpty())
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">User Name</th>
                            <th scope="col">Role</th>
                            </tr>
                        </thead>
                        @foreach ($users as $user)
                        <tbody>
                            <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role }}</td>
                            </tr>
                            <tr>
                        </tbody>
                        @endforeach
                        </table>
                    @else
                        <p>No users yet!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection