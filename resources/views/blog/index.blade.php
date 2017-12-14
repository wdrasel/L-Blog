@extends('layouts.main')

@section('content')
    <div class="container">




        <div class="row">
           {{-- <div class="loader"></div>--}}
            <div class="col-md-8 col-xs-12">


                @if(! $posts->count())
                    <div class="alert alert-warning">
                        <p>Nothing Found</p>
                    </div>
                @else

                @include('blog.alert-info')
                <?php $index = 0;?>

                @foreach($posts as $post)



                    <div class="full-post">
                        <article class="post-item">
                        @if($post->image_url)

                            <div class="post-item-image" style="height: 360px ">
                                <a href="{{route('post.show',$post->slug)}}">
                                    <img src="{{$post->image_url}}" alt="">
                                </a>
                            </div>

                        @endif
                        <div class="post-item-body">
                            <div class="padding-10">
                                <h2><a href="{{route('post.show',$post->slug)}}">{{$post->title}}</a></h2>
                                {!! $post->excerpt_Html !!}
                            </div>

                            <div class="post-meta padding-10 clearfix">
                                <div class="pull-left">
                                    <ul class="post-meta-group">
                                        <li><h5><i class="fa fa-user"></i><a href="{{route('author',$post->author->slug)}}">  {{$post->author->name}}</a></h5></li>
                                        <li><h5><i class="fa fa-clock-o"></i><time> {{$post->date}}</time></h5></li>
                                        <li><h5><i class="fa fa-folder"></i><a href="{{route('category', $post->category->slug)}}">{{$post->category->title}} </a></h5></li>
                                        <li><h5><i class="fa fa-comments"></i><a href="{{route('post.show',$post->slug)}}#post-comments">{{$post->commentsNumber()}}</a></h5></li>
                                    </ul>
                                </div>
                                <div class="pull-right">
                                    <h5><a href="{{route('post.show',$post->slug)}}">Continue..</a></h5>
                                </div>
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

                                {{--slider title & controle--}}

                                <div class="row" style="margin: 0">
                                    <div class="col-md-12 releted-post col-xs-12" id="releted-post">
                                        <h3 class="pull-left"> &nbsp;Related Posts</h3>
                                        <div  class="controls pull-right hidden-xs ">
                                            <a href="#carousel-example{{$index}}"
                                               data-slide="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></a><a href="#carousel-example{{$index}}"
                                                                                                                             data-slide="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>

                                {{--end--}}
                                <hr style="margin: 0">

                                <div id="carousel-example{{$index}}" class="carousel slide hidden-xs" data-ride="carousel">
                                <?php $index++ ?>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">


                                        @foreach($relatedPosts->chunk(2) as $count => $item)

                                            <div class="item {{ $count == 0 ? 'active' : ' ' }}">
                                             <div class="row">


                                                    @foreach($item as $relatedPost)

                                                        <div class="col-sm-6">
                                                            <div class="col-item">
                                                                <div class="photo">
                                                                    <a href="{{route('post.show',$relatedPost->slug)}}"><div class="myfilter"><img src="{{$relatedPost->image_url}}" class="img-responsive" alt="not available photo in this post" /></div></a><div class="carousel-caption" id="carousel-caption">
                                                                        <h4 class="related-h4"><a href="{{route('post.show',$relatedPost->slug)}}">{{str_limit($relatedPost['title'], 40)}}</a></h4>

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
                    </div>



                @endforeach

                <?php $index++?>


                <nav>
                  {{$posts->appends(request()->only(['term','month','year']))->links()}}
                </nav>
            @endif
            </div>

            @include('layouts.sidebar')
        </div>
    </div>

@endsection
