@extends('layouts.main')

@section('content')
  <section id="article">
    <header class="text-center mb-4">
      <img src="{{$post->img_path}}" alt="{{$post->title}}">
      <h1 class="mt-4">{{$post->title}}</h1>
      <h3>{{$post->subtitle}}</h3>
      <small>{{$post->author}} - {{$post->publication_date}}</small>
      <small>{{$post->infoPost->post_status}} - {{$post->infoPost->comment_status}}</small>
    </header>
    <main>
      {{$post->text}}
    </main>
  </section> 
  @if ($post->infoPost->comment_status == 'open')
    <section id="comments" class="my-4">
      <h2>Commenti</h2>
      @foreach ($post->comments as $comment)
        <div class="shadow p-3 mb-5 bg-white rounded">
          <small>{{$comment->author}} - {{$comment->created_at}}</small>
          <p>{{$comment->text}}</p>
        </div>
      @endforeach
    </section>
    <section>
      <form action="{{route('add-comment', $post->id)}}" method="POST">
        @method('POST')
        @csrf
        <div class="form-group">
        <label for="author">Titolo</label>
        <input type="text" class="form-control" name= "author" id="author" placeholder="Scrivi qui il tuo nickname" value="">
      </div>
      <div class="form-group">
        <label for="text">Testo</label>
        <textarea name="text" class="form-control" id="text" rows="6" placeholder="Scrivi qui il tuo commento">{{old('text')}}</textarea>
      </div>
      <input type="submit" value="Invia" class="btn btn-secondary">
      </form>
    </section>
  @endif
@endsection