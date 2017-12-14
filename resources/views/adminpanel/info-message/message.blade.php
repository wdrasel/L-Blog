@if(session('message'))
    <div class="alert alert-info">
        {{session('message')}}
    </div>

@elseif(session('trash-message'))

    <div class="alert alert-warning">
        <?php list($message, $postId) = session('trash-message') ?>

            {!! Form::open(['method'=>'PUT','route'=>['blog.restore',$postId]]) !!}

              {{$message}}
              <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-undo"> Undo Post</i> </button>

            {!! Form::close() !!}

    </div>
@endif