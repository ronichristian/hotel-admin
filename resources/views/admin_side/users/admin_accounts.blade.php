@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin Rooms</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Admin Rooms</li>
            </ol>
        </div>
        </div>
    </div>
</div> 

<div class="panel panel-default">

    <a href="{{url('create_user')}}" class="btn btn-primary btn-sm" >
        Add User
    </a>
        
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Action</th>
                    </tr>
                  </thead>
                <tbody border="1">
                    @foreach ($users as $user)
                        <tr>
                            <th>{{ $user->name }}</th>
                            <th>{{ $user->email }}</th>
                            <th>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</th>
                            <th>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="float-left">
                                    <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm">
                                       <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table class="table table-dark">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th>{{ $user->name }}</th>
                                <th>{{ $user->email }}</th>
                                <th>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</th>
                                <th>
                                    <a href="{{ route('admin.users.edit', $user->id) }}">
                                        <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                    </a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div> --}}
@endsection
