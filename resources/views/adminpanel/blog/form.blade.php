

<div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title') !!}
    {!! Form::text('title',Null ,['class'=>'form-control']) !!}

    @if($errors->has('title'))
        <spam class="help-block">{{$errors->first('title')}}</spam>
    @endif
</div>

<div class="form-group  {{$errors->has('slug') ? 'has-error' : ''}}">
    {!! Form::label('slug','Post URL') !!}
    {!! Form::text('slug',Null  ,['class'=>'form-control']) !!}

    @if($errors->has('slug'))
        <spam class="help-block">{{$errors->first('slug')}}</spam>
    @endif
</div>

<div class="form-group {{$errors->has('excerpt') ? 'has-error' : ''}}">
    {!! Form::label('excerpt') !!}
    {!! Form::textarea('excerpt',Null  ,['class'=>'form-control']) !!}

    @if($errors->has('excerpt'))
        <spam class="help-block">{{$errors->first('excerpt')}}</spam>
    @endif
</div>

<div  class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
    {!! Form::label('body','Body') !!}
    {!! Form::textarea('body',Null  ,['class'=>'form-control']) !!}

    @if($errors->has('body'))
        <spam class="help-block">{{$errors->first('body')}}</spam>
    @endif
</div>
<div class="col-xs-12 col-md-4">
    <div class="form-group {{$errors->has('category_id') ? 'has-error' : ''}}">
        {!! Form::label('category_id','Category') !!}
        {!! Form::select('category_id',App\Category::pluck('title','id'), Null  ,['class'=>'form-control','placeholder'=> 'Chose Category']) !!}

        @if($errors->has('category_id'))
            <spam class="help-block">{{$errors->first('category_id')}}</spam>
        @endif
    </div>

    <div class="form-group {{$errors->has('published_at') ? 'has-error' : ''}}">
        {!! Form::label('published_at','Publish Date') !!}

        <div class="input-group date" id="datetimepicker1">
            {!! Form::text('published_at', Null  ,['class'=>'form-control','placeholder'=>'Y-m-d H:i:s']) !!}
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>

        @if($errors->has('published_at'))
            <spam class="help-block">{{$errors->first('published_at')}}</spam>
        @endif
    </div>



</div>

    <div class="col-xs-12 col-md-4">
        <div class="box" style="margin-top: 22px">
            <div class="box-header with-border">
                <h3 class="box-title">Tags</h3>
            </div>
            <div class="box-body">
                <div class="form-group" id="post_tags">
                    {!! Form::text('post_tags', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

<div class="col-xs-12 col-md-4">
    <div class="form-group {{$errors->has('image')? 'has-error': ''}}">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                <img src="{{($post->image_thumb_url) ? $post->image_thumb_url : 'http://via.placeholder.com/200x150&text=No+Image'}}" alt="...">
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
            <div>
                <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                <span class="fileinput-exists">Change</span>{!! Form::file('image',  Null  ,['class'=>'form-control']) !!}</span>
                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
            </div>
        </div>


        @if($errors->has('image'))
            <span class="help-block">{{$errors->first('image')}}</span>
        @endif

    </div>

</div>

<div class="form-group">

    @if($post->title)
        <button type="submit" class="btn btn-primary btn-lg active">Update Now</button>
   @else
        <button type="submit" class="btn btn-primary btn-lg active">Publish Now</button>
    @endif

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a id="draft-btn" class="btn btn-secondary btn-lg active ">Save Draft</a>







</div>
