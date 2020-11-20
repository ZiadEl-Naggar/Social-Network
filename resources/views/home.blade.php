@extends('base')

@section('script')
    <script src="{{ asset('js/home.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('posts/newpost')

            @if ($posts==null || $posts->isEmpty())
            <div>No posts yet.</div>
            @else
                @include('posts/posts', array('posts' => $posts))
            @endif
        </div>
    </div>
</div>
@endsection