@extends('layouts.app')

@section('title')
Index @endsection


@section('content')
    <h1>List of Users</h1>  

    @if (empty($users))
        <div class="alert alert-warning">The list of users is emty</div>
    @else

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-light">
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Admin since</th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ optional($user->admin_since)->diffForHumans() ?? 'Never'}}</td>
                        <td class="d-inline-flex">

                            <form  action="{{ route('users.admin.toggle', ['user' => $user->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link ">{{ $user->isAdmin() ? 'Remove' : 'Make' }} Admin</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    {{-- @dd(\DB::getQueryLog()) --}}
@endsection