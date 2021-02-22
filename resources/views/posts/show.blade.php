@extends('layouts.main')

@section('header')
  <h1>Dettaglio Post</h1>
  <p>Post status: {{ $post->infoPost->post_status}}</p>
  <p>Comment status: {{ $post->infoPost->comment_status}}</p>
@endsection

@section('content')
  <table class="table table-striped table-bordered">
    @foreach ($post->getAttributes() as $key => $value)
      <tr>
        <td><strong>{{$key}}</strong></td>
        <td>{{$value}} @if ($key == 'img_path')<img src="{{$value}}" alt="">@endif</td>
      </tr>      
    @endforeach
  </table>
  <ul>
    @foreach ($post->comments as $comment)
      <li>
        <p>{{$comment->text}}</p>
        <small>{{$comment->author}}</small>
      </li>
    @endforeach
  </ul>
@endsection

@section('footer')
  <div class="text-right">
    <a href="{{route("posts.index")}}" class="btn btn-primary">Elenco Post</a>
  </div>
@endsection