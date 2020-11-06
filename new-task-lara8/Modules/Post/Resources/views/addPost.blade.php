@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Post') }}</div>
                <!-- Form -->
               
                @if($post[0] ?? "")
                <form method="POST" action="{{ url('post/update') }}" enctype="multipart/form-data" class="mb-4">
               
                    @else
                    <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data" class="mb-4">
                        @endif
                        <input type="hidden" name='slug' value="{{ $post[0]->slug ?? ''  }}">
                        <input type="hidden" name='created_by' value="{{ auth()->user()->id }}">
                        <input type="hidden" name='post_id' value="{{$post[0]->id ?? ''}}">
                        @csrf
                        <!-- Post name -->
                        <div class="form-group">
                            <label>
                                 Title
                            </label>
                            <input type="text" name="title" value="{{$post[0]->title ?? old('title') }}" class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                            @enderror
                        </div>

                        <!-- Post description -->
                        <div class="form-group">
                            <label class="mb-1">
                                Post description
                            </label>
                            
                            <!-- <div data-toggle="quill"></div> -->
                            <textarea name="desc" id="editor" cols="75" class="@error('desc') is-invalid @enderror" rows="8">{{$post[0]->description ?? old('description') }}</textarea>
                            @error('desc')
                            <div class="invalid-feedback">{{ $errors->first('desc') }}</div>
                            @enderror
                        </div>

                      
                        <!-- Post cover -->
                        <div class="form-group">
                            <label class="mb-1">
                                Featured image
                            </label>
                            <small class="form-text text-muted">
                                Please use an image no larger than 1200px * 600px.
                            </small>
                            <div class="dropzone dropzone-single mb-3" data-toggle="dropzone" data-options='{"url": "https://", "maxFiles": 1, "acceptedFiles": "image/*"}'>

                                <div class="fallback">
                                    <div class="custom-file">
                                        <input type="file" name="thumbnail" class="custom-file-input @error('thumbnail') is-invalid @enderror" id="postCoverUploads">
                                        <label class="custom-file-label" for="postCoverUploads">Choose file</label>
                                        @error('featured_image')
                                        <div class="invalid-feedback">{{ $errors->first('featured_image') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- <div class="dz-preview dz-preview-single">
                                    <div class="dz-preview-cover">
                                        <img class="dz-preview-img" src="..." alt="..." data-dz-thumbnail>
                                    </div>
                                </div> -->

                            </div>
                        </div>

                        <!-- Divider -->
                        <hr class="mt-5 mb-5">

                        <!-- Buttons -->
                        @if($post ?? "")
                        <button type="submit" class="btn btn-block btn-primary">
                            Update post
                        </button>
                        @else
                        <button type="submit" class="btn btn-block btn-primary">
                            Create post
                        </button>
                        @endif
                        <a href="#" class="btn btn-block btn-link text-muted">
                            Cancel this post
                        </a>

                    </form>

            </div>
        </div>
    </div>
</div>
@endsection