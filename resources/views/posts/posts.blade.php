<div class="card p-3 mt-2">
    @foreach ($posts as $post)
        <div class="d-flex align-items-start">
            <img class="d-block mr-1" style="max-width: 50px; height: auto; border-radius:50%" src={{$post->user->profile && $post->user->profile->image ? $post->user->profile->image : "/storage/uploads/pp.png"}} alt="">
            <div class="d-flex flex-column">
                <a href="{{ url('/profile/'.$post->user->id) }}"><h3 class="pb-0 mb-0">{{$post->user->name}}</h3></a>
                <div class="d-flex">
                    <small>{{$post->date}}
                    @if ($post->privacy == 'public')
                        <i class="fas fa-globe ml-1"></i>
                    @else
                        <i class="fas fa-lock ml-1"></i>
                    @endif
                    </small>
                </div>
            </div>
            @if ($post->user_id == Auth::user()->id)
                <div class="d-flex flex-fill justify-content-end dropdown">
                    <form action="/post/{{$post->id}}/delete" method="POST">
                        @csrf
                        <button class="btn btn-sm p-0" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" type="submit">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                            </svg>
                        </button>
                        <div class="dropdown-menu p-0" style="min-width: inherit" aria-labelledby="dropdownMenuButton">
                            <button class="dropdown-item p-1" type="submit">Delete</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
        <div class="card-body p-0">
            <div class="">
                <h4>{{$post->content}}</h4>
            </div>

            @if ($post->image != null)
                <img class="card-img-bottom" src="{{$post->image}}" alt=""> 
            @endif
            
            <div class="card-footer p-1 border" id="{{$post->id}}">
                
                {{-- Reacts Section --}}
                <div id="reactssection{{$post->id}}" class="d-flex">
                    <div class="d-flex flex-fill p-0">
                        <button id="thumbs-up" class="btn-lg d-flex col-12 justify-content-center border text-decoration-none thumbs-up">
                            @if (!$post->reacts->isEmpty() && $post->reacts->where('user_id', Auth::user()->id)->pluck('react')->first() == "thumbs-up")
                                <i class="fas fa-thumbs-up"></i>
                            @else
                                <i class="far fa-thumbs-up"></i>
                            @endif
                        </button>
                    </div>
                    <div class="d-flex flex-fill p-0">
                        <button id="heart" class="btn-lg d-flex col-12 justify-content-center border text-decoration-none heart">
                            @if (!$post->reacts->isEmpty() && $post->reacts->where('user_id', Auth::user()->id)->pluck('react')->first() == "heart")
                                <i class="fas fa-heart"></i>
                            @else
                                <i class="far fa-heart"></i>
                            @endif
                        </button>
                    </div>
                    <div class="d-flex flex-fill p-0">
                        <button id="thumbs-down" class="btn-lg d-flex col-12 justify-content-center border text-decoration-none thumbs-down">
                            @if (!$post->reacts->isEmpty() && $post->reacts->where('user_id', Auth::user()->id)->pluck('react')->first() == "thumbs-down")
                                <i class="fas fa-thumbs-down"></i>
                            @else
                                <i class="far fa-thumbs-down"></i>
                            @endif
                        </button>
                    </div>
                </div>

                {{-- Comments Section --}}
                <div class="">
                    <div class="">
                        <textarea id="comment{{$post->id}}" name="postcontent" placeholder="Add a comment..." rows="2" class="form-control input-md p-text-area text-dark"></textarea>
                        <div class="d-flex justify-content-end"><button class="btn btn-sm btn-primary p-1 addcomment" id="" type="submit">Add Comment</button></div>
                    </div>
                    
                    <div id="commentsection{{$post->id}}">
                        @if (!$post->comments->isEmpty())
                            @foreach ($post->comments as $comment)
                                <div class="mb-1 mt-1" id="{{$comment->id}}">
                                    <div class="d-flex align-items-start">
                                        <img class="d-block mr-1" style="max-width: 30px; height: auto; border-radius:50%" src={{$comment->user->profile && $comment->user->profile->image ? $comment->user->profile->image : "/storage/uploads/pp.png"}} alt="">
                                        <div class="d-flex flex-column">
                                            <a href="{{ url('/profile/'.$comment->user->id) }}"><h6 class="pb-0 mb-0">{{$comment->user->name}}</h6></a>
                                            <small>{{$comment->date}}</small>
                                        </div>
                                        @if ($post->user_id == Auth::user()->id || $comment->user_id == Auth::user()->id)
                                            <div class="d-flex flex-fill justify-content-end dropdown">
                                                <button class="btn btn-sm p-0" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" type="submit">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                                    </svg>
                                                </button>
                                                <div class="dropdown-menu p-0" style="min-width: inherit" aria-labelledby="dropdownMenuButton">
                                                    <button class="dropdown-item p-1 deletecomment">Delete</button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <span type="text" readonly class="form-control-plaintext pb-0 pt-0" value="">{{$comment->comment}}</span>
                                </div>
                                <hr class="m-0">
                            @endforeach
                        @else
                            <div id="nocomments{{$post->id}}">
                                No Comments Added.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <hr>
        </div>
    @endforeach
</div>