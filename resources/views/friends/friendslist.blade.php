@extends('base')
@section('title')
<title>Friends</title>
<link rel="icon" href="https://cdn4.iconfinder.com/data/icons/eldorado-user/40/friends-512.png"/>

@section('script')
    <script src="{{ asset('js/friendslist.js') }}" defer></script>
    <link href="{{ asset('css/friends.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid list">
    <div class="row list">
        <div id="sidebar" class="col-3 flex-grow-1k">
            <div class="logo pb-5">
                @if (isset($profile) && isset($profile->image))
                    <a href="{{url('/profile/'.$user->id)}}"><img class="img logo rounded-circle mb-2 mt-2" src="{{$profile->image}}" alt=""></a>
                @else
                    <a href="{{url('/profile/'.$user->id)}}"><img class="img logo rounded-circle mb-2 mt-2" src="storage/uploads/pp.png" alt=""></a>
                @endif
                
                <div class="d-flex justify-content-center">
                    <a href="{{url('/profile/'.$user->id)}}">{{$user->name}}</a>
                 </div>                 
            </div>
            <ul class="nav nav-pills flex-column navlist" id="homeSubmenu">
                <a id="myfriends" href="#" class="nav-item nav-link">
                    <i class="fas fa-user-friends"></i> My Friends
                </a>

                <a id="received-requests" href="#" class="nav-item nav-link">
                    <i class="fa fa-person-add"></i> Received Requests
                </a>

                <a id="sent-requests" href="#" class="nav-item nav-link">
                    <i class="fa fa-sent"></i> Sent Requests
                </a>

                <a id="others" href="#" class="nav-item nav-link">
                    <i class="fa fa-others"></i> Connect with other users.
                </a>
            </ul>
        </div>
        <div class="col-9">
            <div id="list" class="container">
                
            </div>
        </div>
    </div>
</div>
@endsection