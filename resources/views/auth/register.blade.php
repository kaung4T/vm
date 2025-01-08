@extends('template')

@section('content')

<div class="card p-4" style="width: 300px;margin: auto;margin-top: 100px;">

    <div class="card-header">
        <h5>Registration</h4>
    </div>

    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <b class="" role="alert">{{ $errors->first() }}</b>
            </div>
        @endif
        <form action="{{ route('post_register') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
            <input class="form-control" name="name" type="text" placeholder="Username" required>
            </div>

            <div class="mb-3">
            <input class="form-control" name="password" type="password" placeholder="Password" required>
            </div>

            <div class="mb-3 row modal_form_group">
                    <div class="col-sm-9">
                        <select name="role" class="form-select" required>
                            <option disabled selected value> Admin </option>
                            <option  value="admin">Admin</option>
                            <option  value="user"> User </option>
                        </select>
                    </div>
                </div>

            <button class="btn btn-sm btn-primary" type="submit">Register</button> 
        </form>
    </div>

</div>

@endsection