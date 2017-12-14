@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-9 col-xs-12">
                @foreach($posts as $post)
                   <article class="article">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <figure>
                                <img src="{{$post->image_url}}">
                            </figure>
                        </div>
                        <div class="col-sm-6 col-md-8">
                            <span class="label label-default pull-right"><i class="glyphicon glyphicon-comment"></i>{{$post->commentsNumber2()}}</span>
                            <h4>{{str_limit($post['title'],40)}}</h4>
                            <p>{{str_limit($post['excerpt'],200)}}</p>
                            <section>
                                <i class="glyphicon glyphicon-folder-open"></i>{{$post->category->title}}&nbsp
                                <i class="glyphicon glyphicon-user"></i>{{$post->author->name}}&nbsp
                                <i class="fa fa-clock-o"></i> {{$post->date}}&nbsp
                                <a href="{{route('post.show',$post->slug)}}" class="btn btn-default btn-sm pull-right">More ... </a>
                            </section>
                        </div>
                    </div>
                </article>
                @endforeach


            </div>
            @include('layouts.sidebar')
        </div>
    </div>

@endsection
