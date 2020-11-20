<img class="card-img-top" src={{ ($user->profile) && ($user->profile->image != null) ? ($user->profile->image) : "/storage/uploads/pp.png" }} alt="profile_picture">
<div class="card-body p-0">
    <div class="mt-2"><b>Name:</b>&nbsp;{{$user->name}}</div>
    <div class="mt-2"><b>Username:</b>&nbsp;{{$user->username}}</div>
    @if ($user->profile)
        <div class="mt-2">
            <b>Bdate:</b>&nbsp;{{($user->profile->birthdate != null) ? ($user->profile->birthdate) : false}}
        </div>

        <div class="mt-2">
            <b>Education:</b>&nbsp;{{($user->profile->education != null) ? ($user->profile->education) : false}}
        </div>

        <div class="mt-2">
            <b>Work:</b>&nbsp;{{($user->profile->work != null) ? ($user->profile->work) : false}}
        </div>

        <div class="mt-2">
            <b>About:</b>&nbsp;{{($user->profile->about != null) ? ($user->profile->about) : false}}
        </div>
    @else
        <div class="">
            No available information
        </div>
    @endif

    <div class="">
        @if ($profile == 1)
            <a class="btn btn-outline-primary btn-sm mt-4" href="{{route('edit', $user->id)}}"><i class="fas fa-user-edit mr-1"></i>Edit Profile</a>
        @elseif ($profile == 0)
            @if (isset($accepted))
                @if (isset($received) && $received == 1)
                    @if ($accepted == 0)
                        <a href="{{ url('/addfriend/'.$user->id) }}" id="accept" type="submit" class="btn btn-outline-primary btn-sm mt-4"><i class="fas fa-plus-circle mr-1"></i>Accept</a>
                        <a href="{{ url('/removefriend/'.$user->id) }}" id="cancel" type="submit" class="btn btn-outline-primary btn-sm mt-4"><i class="fas fa-minus-circle mr-1"></i>Cancel</a>
                    @elseif ($accepted == 1)
                        <a href="{{ url('/removefriend/'.$user->id) }}" id="friend" type="submit" class="btn btn-outline-primary btn-sm mt-4"><i class="fas fa-check-circle mr-1"></i>Friend</a>
                    @endif
                @else
                    @if ($accepted == 0)
                        <a href="{{ url('/removefriend/'.$user->id) }}" id="sent" type="submit" class="btn btn-outline-primary btn-sm mt-4"><i class="fas fa-paper-plane mr-1"></i>Sent</a>
                    @elseif ($accepted == 1)
                        <a href="{{ url('/removefriend/'.$user->id) }}" id="friend" type="submit" class="btn btn-outline-primary btn-sm mt-4"><i class="fas fa-check-circle mr-1"></i>Friend</a>
                    @endif
                @endif
            @else
                <a href="{{ url('/addfriend/'.$user->id) }}" id="add" type="submit" class="btn btn-outline-primary btn-sm mt-4"><i class="fas fa-plus-circle mr-1"></i>Add Friend</a>
            @endif
        @endif
    </div>
</div>