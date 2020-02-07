@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $post->title }}
                    <hr>
                    Author: <a href="{{ route('profile', ['id' => $user->id]) }}">{{ $user->name }}</a>
                </div>

                <div class="card-body">
                    {{ $post->content }}
                </div>

                <div class="card-footer">
                    <h3>Comments:</h3>
                    <hr>
                    @forelse($comments as $comment)
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset('storage/profile/' . $comment->user_id . '_profile') }}" width="100%" height="100%">
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('profile', ['id' => $comment->id]) }}">{{ $comment->user_name }}</a>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $comment->content }}</p>
                            </div>
                        </div>
                        <hr>
                    @empty
                        <div class="row">
                            <div class="col-md-8">
                                <h4>No comments</h4>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="col-md-8">
                    <form method="POST" action="{{ route('create.comment') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Text') }}</label>

                            <div class="col-md-8">
                                <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" required autocomplete="content" autofocus>{{ old('content') }}</textarea>
                            </div>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <input type="hidden" name="post" value="{{ $post->id }}">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Comment') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
