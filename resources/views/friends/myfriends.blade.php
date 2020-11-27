<div class="row pt-2">
    @if (!$friends->isEmpty())
        @foreach ($friends as $friend)
            <div class="card col-3 mr-2 mb-2">
                @if (isset($friend->profile) && isset($friend->profile->image))
                    <a class="card-img-top"  href="{{url('/profile/'.$friend->id)}}"><img class="friend-image" src="{{$friend->profile->image}}" alt=""></a>
                @else
                    <a class="card-img-top" href="{{url('/profile/'.$friend->id)}}"><img class="friend-image" src="storage/uploads/pp.png" alt=""></a>
                @endif
                <div class="card-body d-flex justify-content-center p-1">
                    <a href="{{url('/profile/'.$friend->id)}}">{{$friend->name}}</a>
                </div>
            </div>
        @endforeach
    @else
        Nothing here.
    @endif
</div>