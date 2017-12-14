<div class="col-md-4 col-xs-12 ">
    <aside class="right-side">
        
        <div class="widget">
            <div class="widget-heading">
                <h4><i class="fa fa-bars" aria-hidden="true"></i>
                    &nbsp; Categories</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    @foreach($categories as $category)
                    <li>
                        <a href="{{Route('category', $category->slug)}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                            &nbsp;  {{$category->title}}</a>
                        <span id="badge" class="badge pull-right">{{$category->posts->count()}}</span>
                    </li>

                    @endforeach

                </ul>
            </div>
        </div>

            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="tab-row">
                        <div class="befor-widget">
                            <div class="populat-post-tab">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#home" aria-controls="home" role="tab"
                                           data-toggle="tab">Popular</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#profile" aria-controls="profile" role="tab"
                                           data-toggle="tab">Latest</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#messages" aria-controls="messages" role="tab"
                                           data-toggle="tab">Tags</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                        @foreach($popularPosts as $populaPost )
                                            <div class="tab-post-list">
                                                <div class="tab-post-list-wrap clearfix">
                                                    <div class="tab-post-thumb pull-left">
                                                        @if($populaPost->image_thumb_url)
                                                            <figure>
                                                                <a href="{{route('post.show',$populaPost->slug)}}">
                                                                    <img src="{{$populaPost->image_thumb_url}}"
                                                                         alt="Post thumb">
                                                                </a>
                                                            </figure>
                                                        @endif
                                                    </div>
                                                    <div class="tab-post-title">
                                                        <h4 class="popular-h4">{{str_limit($populaPost['title'], 45)}}</h4>
                                                        <span>{{$populaPost->date}}</span> |
                                                        <i class="fa fa-comments"></i> <a href="{{route('post.show',$populaPost->slug)}}">{{$populaPost->commentsNumber()}}</a>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="profile">
                                        @foreach($latestPostss as $latestPost )
                                            <div class="tab-post-list">
                                                <div class="tab-post-list-wrap clearfix">
                                                    <div class="tab-post-thumb pull-left">
                                                        @if($latestPost->image_thumb_url)
                                                            <figure>
                                                                <a href="{{route('post.show',$latestPost->slug)}}">
                                                                    <img src="{{$latestPost->image_thumb_url}}"
                                                                         alt="Post thumb">
                                                                </a>
                                                            </figure>
                                                        @endif
                                                    </div>
                                                    <div class="tab-post-title">
                                                        <h4 class="popular-h4">{{str_limit($latestPost['title'], 45)}}</h4>
                                                        <span>{{$latestPost->date}}</span> |
                                                        <i class="fa fa-comments"></i> <a href="{{route('post.show',$latestPost->slug)}}">{{$latestPost->commentsNumber()}}</a>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>




                                    <div role="tabpanel" class="tab-pane" id="messages">
                                        <div class="tab-post-list">
                                            <ul class="tags">

                                                @foreach($tags as $tag)

                                                    <li><a href="{{route('tag',$tag->slug)}}">{{$tag->name}}</a></li>
                                                @endforeach




                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <div class="widget">
            <div class="widget-heading">
                <h4>ACHIVES</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    @foreach($archives as $archive)

                    <li>
                        <a href="{{route('blog',['month'=> $archive->month, 'year' => $archive->year])}}">{{$archive->month. " " .  $archive->year}}</a>
                        <span id="badge" class="badge pull-right">{{$archive->post_count}}</span>
                    </li>

                    @endforeach

                </ul>
            </div>
        </div>

    </aside>
</div>