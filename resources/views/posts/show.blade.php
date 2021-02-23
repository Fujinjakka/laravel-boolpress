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

  <h2>CAROSELLO</h2>

    {{-- <div class="main">
      <div class="slider slider-for">
        @foreach ($post->images as $image)
          <div><h3><img src="{{$image->link}}" alt="photo"></h3></div>
        @endforeach      
      </div>
      <div class="slider slider-nav black">
        @foreach ($post->images as $image)
          <div><h3><img src="{{$image->link}}" alt="photo"></h3></div>   
        @endforeach
      </div>
      <div class="action">
        <a href="#" data-slide="3">go to slide 3</a>
        <a href="#" data-slide="4">go to slide 4</a>
        <a href="#" data-slide="5">go to slide 5</a>
      </div>
    </div> --}}

  <div class="slick-carousel">
    @foreach ($post->images as $image)
      <div><img src="{{$image->link}}" style="width: 90%"></div>  
    @endforeach
  </div>



@endsection

@section('footer')
  <div class="text-right">
    <a href="{{route("posts.index")}}" class="btn btn-primary">Elenco Post</a>
  </div>
@endsection