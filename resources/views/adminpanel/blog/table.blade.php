<table class="table table-bordered table-inverse table-striped col-xs-12">
    <thead>
    <tr>
        <td width="140">Features Images</td>
        <td>Title</td>
        <td width="120">Author</td>
        <td width="150">Category</td>
        <td width="120">Date</td>
        <td width="100">Status</td>
        <td width="100">Views</td>
        <td width="140">Operations</td>
    </tr>
    </thead>
    <tbody>
    <?php $request = request() ?>
    @foreach($posts as $post)

        <tr>
            <td>
                <img style="width:120px; height: 70px" src="{{($post->image_thumb_url)? $post->image_thumb_url : 'http://via.placeholder.com/120x70&text=No+Image'}}" alt="">
            </td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->author->name }}</td>
            <td>{{ $post->category->title }}</td>
            <td>
                <abbr title="{{ $post->dateFormatted(true) }}">{{ $post->dateFormatted() }}</abbr>
            </td>

            <td>{!! $post->publicationLabel() !!}</td>
            <td><i class="fa fa-eye" aria-hidden="true"></i> {{$post->view_count}}</td>
            <td>
                {!! Form::open(['method'=>'DELETE','route'=>['blog.destroy',$post->id]]) !!}

                @if(check_user_permissions($request,"Blog@edit", $post->id))
                <a  href="{{ route('blog.edit', $post->id) }}" class="btn btn-info">
                    Edit
                </a>
                @else
                    <a  href="#" class="btn btn-info disabled">
                        Edit
                    </a>
                @endif

                @if(check_user_permissions($request, "Blog@destroy", $post->id))
                <button type="submit" class="btn btn-danger">
                    Delete
                </button>
                @else
                <button type="button" onclick="return false" class="btn btn-danger disabled">
                    Delete
                </button>
                @endif


                {!! Form::close() !!}


            </td>

        </tr>

    @endforeach
    </tbody>
</table>