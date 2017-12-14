<table class="table table-bordered">
    <thead>
    <tr>
        <td width="80">Action</td>
        <td>Title</td>
        <td width="120">Author</td>
        <td width="150">Category</td>
        <td width="170">Date</td>
    </tr>
    </thead>
    <tbody>
    <?php $request = request()?>

    @foreach($posts as $post)

        <tr>
            <td>
                {!! Form::open([ 'style' =>'display: inline-block;', 'method'=>'PUT','route'=>['blog.restore',$post->id]]) !!}

                @if(check_user_permissions($request , "Blog@restore", $post->id))
                    <button type="submit" title="Restore"  class="btn btn-xs btn-default">
                        <i class="fa fa-undo"></i>
                    </button>
                @else
                    <button type="button" onclick="return false" title="Restore"  class="btn btn-xs btn-default disabled">
                        <i class="fa fa-undo"></i>
                    </button>
                @endif

                {!! Form::close() !!}

                {!! Form::open(['style' =>'display: inline-block;','method'=>'DELETE','route'=>['blog.force-destroy',$post->id]]) !!}

                @if(check_user_permissions($request ,"Blog@forceDestroy",$post->id ))
                    <button title="Permanent Delete" onclick="return confirm('Are you sure you want to delete this post') "  type="submit" class="btn btn-xs btn-danger">
                        <i class="fa fa-times"></i>
                    </button>
                @else
                    <button title="Permanent Delete" onclick="return false"  type="submit" class="btn btn-xs btn-danger disabled">
                        <i class="fa fa-times"></i>
                    </button>
                @endif

                {!! Form::close() !!}


            </td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->author->name }}</td>
            <td>{{ $post->category->title }}</td>
            <td>
                <abbr title="{{ $post->dateFormatted() }}">{{ $post->dateFormatted() }}</abbr>
            </td>
        </tr>

    @endforeach
    </tbody>
</table>