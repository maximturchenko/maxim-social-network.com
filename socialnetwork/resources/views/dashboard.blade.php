@extends('layouts.master')

@section('content')
@include('includes.errors')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>What do you have to say?</h3></header>
            <form action="{{ route('post.create') }}" method="post">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
             </div>
                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>What other people say...</h3></header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{ $post->id }}">
                    <p>{{ $post->body }}</p>
                    <div class="info">
                        Posted by {{ $post->user->first_name }} on {{ $post->created_at }}
                    </div>
                    <div class="interaction">
                        @if(Auth::user() == $post->user)
                        |
                        <a href="#" class="edit">Edit</a> |
                        <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>


    <div class="modal" tabindex="-1" role="dialog" id="editpostModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('post.edit') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <textarea class="form-control" name="body" id="edit-post" rows="5" placeholder="Your Post"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Post</button>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary savechanges">Save changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <script>
            var url = {{route("post.edit")}};
        </script>
@endsection
