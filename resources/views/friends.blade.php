@if (sizeof($friends) > 0)
    <div class="card card-inverse card-info p-2">
        <h4 class="card-header mb-0">My Friends</h4>
        <div class="card-body p-0 mt-2">
            @foreach ($friends as $key=>$value)
                <a href="{{ url('/profile/'.$key) }}">{{$value}}</a>
            @endforeach
        </div>
    </div>
@else
    <div class="">
        No friends yet.
    </div>
@endif