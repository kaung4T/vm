@extends('template')

@section('content')

<div class="card p-4" style="width: 300px;margin: auto;margin-top: 100px;">

    <div class="card-header">
        <h5>Login</h4>
    </div>

    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <b class="" role="alert">{{ $errors->first() }}</b>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <form action="{{ route('post_login') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
            <input class="form-control" name="name" type="text" placeholder="Username" required>
            </div>

            <div class="mb-3">
            <input class="form-control" name="password" type="password" placeholder="Password" required>
            </div>

            <button class="btn btn-sm btn-primary" type="submit">Login</button> 
            <span style="color:#495057;font-size: 0.8rem;">Create an account? <a href="{{ route('register') }}">Create</a></span>
        </form>
    </div>

</div>

@endsection