@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<main>
    <div class="container" style="width: 100%">
        <div class="card mb-4 mt-5">
            <div class="card-header">
                <div class="row">
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="col">
                        <h2>User list</h2>
                    </div>
                    <div class="col-md-6">
                        <form class="d-flex" role="search" action="" method="GET" name="search">
                            <input name="query" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Email User</th>
                        <th scope="col">PassWord</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{$user->email }}</td>
                            <td> 
                                <form method="POST" action="{{ url('/admin/adminDashboard/users/user/' . $user->id)}}" accept-charset="UTF-8" style="display:inline">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                        <i class="fa fa-trash" class="fa fa-trash-o" aria-hidden="true"></i> Delete User!!
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
        </div>
    </main>
@endsection
