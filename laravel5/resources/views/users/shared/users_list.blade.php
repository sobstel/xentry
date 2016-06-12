<table class="table">
    <tr>
        <th>Avatar</th>
        <th>Name</th>
        <th>Theme</th>
        <th>Actions</th>
    </tr>
    @foreach ($users as $user)
        <tr>
            <td>
                @if ($user->avatar_file)
                    <img src="{{ env('IMAGE_BASE_PATH') }}{{ $user->avatar_file }}" width="50" height="50">
                @endif
            </td>
            <td>
                @if ($linkify_user)
                    <a href="{{ route('users.show', $user) }}">
                @endif

                {{ $user->name }}

                @if ($linkify_user)
                    </a>
                @endif
            </td>
            <td>
                {{ $user->theme }}
            </td>
            <td>
                @if ($user->id != Auth()->user()->id)
                    @if (!$user->currentUserFollowing)
                    <form action="{{ route('user.follow', $user) }}" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <button class="btn btn-default">Follow</button>
                    </form>
                    @else
                    <form action="{{ route('user.unfollow', $user) }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <button class="btn btn-default">Unfollow</button>
                    </form>
                    @endif
                @endif
            </td>
        </tr>
    @endforeach
</table>
