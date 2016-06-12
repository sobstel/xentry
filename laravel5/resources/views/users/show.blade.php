@extends('layouts.app')

@section('content')

<div class="panel-heading">User profile: {{ $user->name }}</div>

<div class="panel-body">
    @include('users.shared.users_list', ['users' => [$user], 'linkify_user' => false])

    @if (!$user->followers->isEmpty())
    <table class="table">
        <thead>
            <tr>
                <th>
                    Followers
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @foreach ($user->followers as $i => $follower)
                        <a href="{{ route('users.show', $follower) }}">
                            {{ $follower->name }}@if ($i < count($user->followers) - 1), @endif
                        </a>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
    @endif

    @if (!$user->activities->isEmpty())
    <table class="table">
        <thead>
            <tr>
                <th colspan="3">
                    Activities
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->activities as $activity)
                <tr>
                    <td>
                        {{ $activity->created_at }}
                    </td>
                    <td>
                        {{ $activity->action }}
                    </td>
                    <td>
                        <a href="{{ route('users.show', $activity->fromUser) }}">
                            {{ $activity->fromUser->name }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@endsection
