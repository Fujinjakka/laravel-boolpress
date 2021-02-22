@extends('layouts.main')

@section('header')
  <h1>Scrivi un nuovo Post</h1>  
@endsection


@section('content')

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{route("posts.store")}}" method="POST">
    @csrf
    @method("POST")
    <div class="form-group">
      <label for="title">Titolo</label>
      <input type="text" class="form-control" name= "title" id="title" placeholder="titolo" value="{{old('title')}}">
    </div> 
    <div class="form-group">
      <label for="subtitle">Sottotitolo</label>
      <input type="text" class="form-control" name= "subtitle" id="subtitle" placeholder="Sottotitolo" value="{{old('subtitle')}}">
    </div> 
    <div class="form-group">
      <label for="text">Testo</label>
      <textarea name="text" class="form-control" id="text" rows="6" placeholder="Corpo del post">{{old('text')}}</textarea>
    </div>
    <div class="form-group">
      <label for="author">Autore</label>
      <input type="text" class="form-control" name= "author" id="author" placeholder="Autore" value="{{old('author')}}">
    </div>
    <div class="form-group">
      <label for="img_path">Immagine</label>
      <input type="text" class="form-control" name= "img_path" id="img_path" placeholder="immagine" value="{{old('img_path')}}">
    </div>
    <div class="form-group">
      <label for="publication_date">Data di pubblicazione</label>
      <input type="date" class="form-control" name= "publication_date" id="publication_date" placeholder="data di pubblicazione" value="{{old('publication_date')}}">
    </div>

    <div class="from-group">
      <label for="post_status">Stato del Post</label>
      <select class="custom-select" name="post_status" id="post_status">
        <option value="draft" {{old('post_status') == 'draft' ? 'selected' : ''}}>Draft</option>
        <option value="private" {{old('post_status') == 'private' ? 'selected' : ''}}>Private</option>
        <option value="public" {{old('post_status') == 'public' ? 'selected' : ''}}>Public</option>
      </select>
    </div>
    <div class="from-group">
      <label for="comment_status">Stato del Post</label>
      <select class="custom-select" name="comment_status" id="comment_status">
        <option value="open" {{old('comment_status') == 'open' ? 'selected' : ''}}>Open</option>
        <option value="closed" {{old('comment_status') == 'closed' ? 'selected' : ''}}>Closed</option>
        <option value="private" {{old('comment_status') == 'private' ? 'selected' : ''}}>Private</option>
      </select>
    </div>
    @foreach ($tags as $tag)
      <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="{{$tag->id}}" name="tags[]" value="{{$tag->id}}">
        <label class="custom-control-label" for="{{$tag->id}}">{{$tag->name}}</label>
      </div>
    @endforeach

    <div class="my-4">
      <button type="submit" class="btn btn-success">Salva</button>
      <a href="{{route("posts.index")}}" class="btn btn-primary float-right">Elenco post</a>
    </div>

  </form>  
@endsection
