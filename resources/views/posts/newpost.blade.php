<div class="card">
    <form action="/post" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="">
            <textarea id="postcontent" name="postcontent" placeholder="Whats on your mind today?" rows="1" class="form-control input-md p-text-area text-dark @error('postcontent') is-invalid @enderror"></textarea>
            @error('postcontent')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="card-footer p-2">
                <button type="submit" class="btn btn-primary btn-sm pull-right">Post</button>
                
                <label for="image">
                    <a class="btn-lg"><i class="fa fa-camera"></i></a>
                </label>
                <input type="file" name="image" id="image" class="form-control-file @error('postcontent') is-invalid @enderror">
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="d-inline-flex">
                    <div class="form-check m-2">
                        <input class="form-check-input" type="radio" name="privacy" id="public" value="public" checked>
                        <label class="form-check-label" for="public">
                            <a class="btn-sm p-0"><i class="fas fa-globe"></i></a> Public
                        </label>
                    </div>
                    <div class="form-check m-2">
                        <input class="form-check-input" type="radio" name="privacy" id="private" value="private">
                        <label class="form-check-label" for="private">
                            <a class="btn-sm p-0"><i class="fas fa-lock"></i></a> Private
                        </label>
                    </div>
                </div>
                
            </div>
        </div>
    </form>
</div>