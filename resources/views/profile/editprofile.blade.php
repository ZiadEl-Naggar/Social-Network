@extends('base')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <form action="/profile" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-3">
                            <div class="editPP row">
                                <img src="{{ $user->profile && $user->profile->image ? $user->profile->image : "/storage/uploads/pp.png" }}" alt="profile_picture">
                                
                                <label for="image">
                                    <a class="btn-lg"><i class="fas fa-images"></i></a>
                                </label>
                                <input type="file" name="image" id="image" class="form-control-file @error('postcontent') is-invalid @enderror">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-10 mt-2">
                                    <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') ? old('name') : $user->name }}" autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-10 mt-2">
                                    <input id="bdate" type="text" class="form-control form-control-sm @error('bdate') is-invalid @enderror" name="bdate" value="{{ old('bdate') ? old('bdate') : ($user->profile ? $user->profile->birthdate : '') }}" autocomplete="bdate" autofocus>
    
                                    @error('bdate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-6 d-flex flex-column justify-content-center">
                            <div class="form-group row align-items-center">
                                <label for="education" class="col-2 col-form-label text-md-right">{{ __('Education') }}</label>
                                <div class="col-8 mt-2">
                                    <input id="education" type="text" class="form-control @error('education') is-invalid @enderror" name="education" value="{{ old('education') ? old('education') : ($user->profile ? $user->profile->education : '') }}" autocomplete="education" autofocus>
    
                                    @error('education')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row align-items-center">
                                <label for="work" class="col-2 col-form-label text-md-right">{{ __('Work') }}</label>
                                <div class="col-8 mt-2">
                                    <input id="work" type="text" class="form-control @error('work') is-invalid @enderror" name="work" value="{{ old('work') ? old('work') : ($user->profile ? $user->profile->work : '') }}" autocomplete="work" autofocus>
    
                                    @error('work')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row align-items-start">
                                <label for="about" class="col-2 col-form-label text-md-right">{{ __('About') }}</label>
                                <div class="col-8 mt-2">
                                    <textarea id="about" type="text" rows="5" class="form-control @error('about') is-invalid @enderror" name="about" autocomplete="about" autofocus>{{ old('about') ? old('about') : ($user->profile ? $user->profile->about : '') }}</textarea>
    
                                    @error('about')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <button type="submit" class="btn btn-primary btn-sm pull-right">Edit Profile</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection