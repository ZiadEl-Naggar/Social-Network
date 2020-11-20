@extends('base')
{{-- @section('title', 'Profile') --}}

@section('script')
    <script src="{{ asset('js/profile.js') }}" defer></script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center ml-2 mr-2 p-2">
        <div class="col-12 p-2 row">
            <div class="col-2 card card-inverse card-info p-2">
                @include('profile/info')
            </div>
            
            {{-- Posts Section --}}
            <div class="col-8">
                @if ($profile == 1)
                    @include('posts/newpost')
                @endif
                
                @if ($posts==null || $posts->isEmpty())
                    <div>No posts yet.</div>
                @else
                    @include('posts/posts', array('posts' => $posts))
                @endif
                
            </div>

            {{-- Friends Section --}}
            <div class="col-2">
                @if ($profile == 1)
                    @include('friends')
                @endif
            </div>
        </div>
    </div>
</div>
@endsection