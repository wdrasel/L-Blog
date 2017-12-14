<article class="post-comments" id="post-comments">


    <h3><i class="fa fa-comments"></i> {{$post->commentsNumber()}} </h3>


    <section class="comments">
        @foreach($postComments as $comment)
        <article class="comment">
            <a class="comment-img" href="#non">
                <img src="" alt="" width="40" height="40" />
            </a>

            <div class="comment-body">
                <div class="text">
                    <p>{!! $comment->body_html !!}</p>
                </div>
                <p class="attribution">by <a href="#non">{{$comment->author_name}}</a> &nbsp   <i class="fa fa-clock-o" aria-hidden="true"></i>
                    {!! $comment->date  !!}</p>
            </div>
        </article>
        @endforeach
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$postComments->render()}}
    </section>​



    {{--comment input section--}}
    <div class="comment-footer padding-10">
        <h3 id="post-comment-h3">write a comment</h3>

        @if(session('message'))
            <div class="alert alert-info">
                {{session('message')}}
            </div>
        @endif

         {!! Form::open(['route' => ['blog.comments',$post->slug]]) !!}

            <div class="col-md-4 form-group required {{$errors->has('author_name') ? 'has-error' : ''}}">
                <label for="name">Name</label>
                {!! Form::text('author_name',null,['class'=> 'form-control']) !!}
                @if($errors->has('author_name'))
                    <span class="help-block">
                        <strong>{{$errors->first('author_name')}}</strong>
                    </span>
                @endif
            </div>
            <div class=" col-md-4 form-group required {{$errors->has('author_email') ? 'has-error' : ''}}">
                <label for="email">Email</label>
                {!! Form::text('author_email',null,['class'=> 'form-control']) !!}
                @if($errors->has('author_email'))
                    <span class="help-block">
                        <strong>{{$errors->first('author_email')}}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-4 form-group">
                <label for="website">Website</label>
                {!! Form::text('author_url',null,['class'=> 'form-control']) !!}
            </div>
            <div class="col-md-12 form-group required {{$errors->has('body') ? 'has-error' : ''}}">
                <label for="comment">Comment</label>
                {!! Form::textarea('body',null, ['row'=> 6,'class'=> 'form-control']) !!}
                @if($errors->has('body'))
                    <span class="help-block">
                        <strong>{{$errors->first('body')}}</strong>
                    </span>
                @endif
            </div>
            <div class="clearfix">
                <div class="pull-left">
                    <button type="submit" class="btn btn-lg btn-success">Submit</button>
                </div>
                <div class="pull-right">
                    <p class="text-muted">
                        <span class="required">*</span>
                        <em>Indicates required fields</em>
                    </p>
                </div>
            </div>
       {!! Form::close() !!}
    </div>

</article>
