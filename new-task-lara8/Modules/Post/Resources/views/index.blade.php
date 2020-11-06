@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif
                    <div class="container">
                        @can('create',App\Modles\Post::class)
                        <a href="{{ route('post.create') }}" class="btn btn-success mb-2">Add Post</a> <br>
                        @endcan
                        <div class="row">
                            <div class="col-12">
                                @if(isset($posts[0]))
                                <table class="table table-bordered" id="laravel_unique_slug_table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Thumbnail</th>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($posts as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td> @if(isset($post->featured_image))
                                                <img src="{{ asset($post->featured_image) }}" alt="{{ basename($post->featured_image) }}" class="card-img-top" >
                                                @else
                                                <img src="assets/img/default.png" class="card-img-top">
                                                @endif
                                            </td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->slug }}</td>
                                            <td>
                                                <a onclick="window.lara.getDescription('{{$post->slug}}')" class="btn btn-warning mb-2" data-toggle="modal" data-target="#descModal">View</a>
                                                @can('edit',App\Modles\Post::class)
                                                <a href="{{ route('post.edit',$post->slug) }}" class="btn btn-primary mb-2">Edit</a>
                                                @endcan
                                                @can('delete',App\Modles\Post::class)
                                                <a onclick="window.lara.destroyPost('{{$post->slug}}')" class="btn btn-danger mb-2">Delete</a>
                                                @endcan
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                <h3>No Post Pvailable</h3>
                                @endif
                                <nav aria-label="...">
                                    <ul class="pagination">

                                        {!! $posts->links() !!}
                                    </ul>
                                </nav>
                            </div>
                            <div class="modal fade" id="descModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $post->title ?? ''  }} Description</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id='postDesc'>
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection