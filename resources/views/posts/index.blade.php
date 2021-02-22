@extends('layouts.main')

@section('header')
  <h1>I Miei Post</h1>   
@endsection


@section('content')
  @if(session('message'))
    <div class="alert alert-success">{{session("message")}}</div>  
  @endif
  <table class="table table-dark table-striped table-bordered">
    <thead>
      <tr>
        <th>ID: </th>
        <th>TITOLO: </th>
        <th>SLUG: </th>
        <th>SOTTOTITOLO: </th>
        <th>TESTO: </th>
        <th>AUTORE: </th>
        <th>IMMAGINE: </th>
        <th>CREATO IL: </th>
        <th>AGGIORNATO IL: </th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
        <tr>
          <td>{{$post->id}}</td>
          <td>{{$post->title}}</td>
          <td>{{$post->slug}}</td>
          <td>{{$post->subtitle}}</td>
          <td>{{substr($post->text, 0, 20)}}</td>
          <td>{{$post->author}}</td>
          <td><img style="height: 150px" src="{{$post->img_path}}" alt="{{$post->title}}"> </td>
          <td>{{$post->created_at}}</td>
          <td>{{$post->updated_at}}</td>
          <td><a href="{{route("posts.show", ["post" => $post->id])}}" class="btn btn-outline-light"><i class="fas fa-eye"></i></a></td>
          <td><a href="{{route("posts.edit", ["post" => $post->id])}}" class="btn btn-outline-light"><i class="fas fa-edit"></i></a></td>
          <td>
            <form action="{{route("posts.destroy", $post->id)}}" method="POST">
              @csrf
              @method("DELETE")
              <button type="submit" class="btn btn-outline-light"><i class="fas fa-trash"></i></button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection

@section('footer')
  <div class="text-right">
    <a href="{{route("posts.create")}}" class="btn-primary btn-lg">Inserisci un nuovo Post</a>
  </div>
@endsection