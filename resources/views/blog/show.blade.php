@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="full-post">
                <article class="post-item post-detail">
                    @if($post->image_url)
                    <div class="post-item-image">
                            <img alt="{{$post->title}}" src="{{$post->image_url}}">
                    </div>
                    @endif
                    <?php $author= $post->author?>
                    <div class="post-item-body">
                        <div class="padding-10">
                            <h1>{{$post->title}}</h1>

                            <div class="post-meta no-border">
                                <ul class="post-meta-group">
                                    <li><i class="fa fa-user"></i><a href ="{{route('author',$author->slug)}}"> {{$author->name}}</a></li>
                                    <li><i class="fa fa-clock-o"></i><time> {{$post->date}}</time></li>
                                    <li><i class="fa fa-folder"></i><a href="{{route('category', $post->category->slug)}}"> {{$post->category->title}}</a></li>
                                    <li><i class="fa fa-tags"></i>{!! $post->tags_html !!}</li>
                                    <li><i class="fa fa-comments"></i><a href="#post-comments">{{$post->commentsNumber()}}</a></li>
                                </ul>
                            </div>

                            {!! $post->body !!}



                        </div>
                    </div>
                </article>

                {{--Releted Post--}}

                    <?php

                    $post->load(['category.posts' => function ($q) use (& $relatedPosts, $post) {

                        $relatedPosts = $q->where('id', '!=', $post->id)->get()->unique()->take(8);


                    }]);

                    ?>




                    <div class="row" id="row">
                        <div class="row" style="margin: 0">
                            <div class="col-md-12 col-xs-18 releted-post" id="releted-post">
                                <h3 class="pull-left"> &nbsp;Related Posts</h3>

                                <div  class="controls pull-right hidden-xs ">
                                    <a href="#carousel-example"
                                       data-slide="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></a><a href="#carousel-example"
                                                                                                                data-slide="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">

                                @foreach($relatedPosts->chunk(2) as $count => $item)

                                    <div class="item {{ $count == 0 ? 'active' : ' ' }}">
                                        <div class="row">

                                            @foreach($item as $relatedPost)

                                                <div class="col-sm-6">
                                                    <div class="col-item">
                                                        <div class="photo">
                                                            <a href="{{route('post.show',$relatedPost->slug)}}"><img src="{{$relatedPost->image_url}}" class="img-responsive" alt="not available photo in this post" /></a>
                                                            <div class="carousel-caption" id="carousel-caption">
                                                                <h4 class="related-h4">{{str_limit($relatedPost['title'], 40)}}</h4>

                                                            </div>
                                                        </div>
                                                        <div class="info">
                                                            <div class="separator clear-left">
                                                                <p class="btn-add">
                                                                    <i class="fa fa-clock-o"></i><time> {{$relatedPost->date}}</time>
                                                                <p class="btn-details">
                                                                    <i class="fa fa-list"></i><a href="{{route('post.show',$relatedPost->slug)}}" class="hidden-sm">More details</a></p>
                                                            </div>
                                                            <div class="clearfix">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            @endforeach
                                        </div>
                                    </div>


                                @endforeach


                            </div>


                        </div>
                    </div>



                </div> {{--end full post and related post--}}

                <article class="post-author padding-10">
                    <div class="media">
                      <div class="media-left">
                        <a href="{{route('author',$author->slug)}}">
                          <img alt="{{$author->name}}" height="100" width="100"  src="{{$author->gravatar()}}" class="media-object">
                        </a>
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading"><a href="#">{{$author->name}}</a></h4>
                        <div class="post-author-count">
                          <a href="{{route('author',$author->slug)}}">
                              <i class="fa fa-clone"></i>
                              {{$author->posts()->published()->count()}} Posts
                          </a>
                        </div>
                         {!! $author->bio_html !!}
                      </div>
                    </div>
                </article>

                @include('blog.comments')
            </div>

            @include('layouts.sidebar')
        </div>
    </div>

@endsection
