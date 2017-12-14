

<div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title') !!}
    {!! Form::text('title', Null ,['class'=>'form-control']) !!}

    @if($errors->has('title'))
        <spam class="help-block">{{$errors->first('title')}}</spam>
    @endif
</div>

<div class="form-group  {{$errors->has('slug') ? 'has-error' : ''}}">
    {!! Form::label('slug','Category URL') !!}
    {!! Form::text('slug', Null  ,['class'=>'form-control']) !!}

    @if($errors->has('slug'))
        <spam class="help-block">{{$errors->first('slug')}}</spam>
    @endif
</div>

<div>
    <button type="submit" class="btn btn-primary">{{$category->exists ? 'Update Category': 'Add Category'}}</button>
    <a href="{{route('categories.index')}}" class="btn btn-default">Cancel</a>
</div>


