@extends('layout')

@section('content')
    <div class="list-user">]
        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Họ tên</th>
                            <th>Ngày sinh</th>
                            <th>Quyền hạn</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->user_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->userdetail->full_name }}</td>
                                <td>{{ $user->userdetail->date_of_birth }}</td>
                                @if ($user->is_admin == 1)
                                    <td>Admin</td>
                                @else
                                    <td>User</td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
