@extends('layouts.app')

@section('content')

<div class="panel-heading">Users</div>

<div class="panel-body">
    @include('users.shared.users_list', ['users' => $users, 'linkify_user' => true])
</div>

@endsection
