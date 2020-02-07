@extends('user.layouts.app_user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{asset( 'storage/' . $user->img)}}" width="100%" height="100%">
                        </div>
                        <div class="col-md-4">
                            Name: {{$pr_user->name}}
                        </div>
                    </div>


                    @if(!$guest)
                        <a href="{{ route('create.post') }}">Create Post</a>
                    @endif

                    <hr>

                    <div class="row">
                        @forelse($posts as $post)
                            <div class="col-md-8">
                                <h3><a href="{{ route('post', ['id' => $post->id]) }}">{{ $post->title }}</a></h3>
                                @if(!$guest)
                                    <a href="{{ route('edit.post', ['id' => $post->id]) }}">Edit</a>
                                @endif
                                <p>{{ $post->content }}</p>
                            </div>
                        @empty
                            <div class="col-md-8"><h3>Post not found</h3></div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
