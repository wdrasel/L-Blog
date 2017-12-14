<table class="table table-bordered">
    <thead>
    <tr>

        <td width="200">Category Name</td>
        <td width="120">Post Count</td>
        <td width="60">Operations</td>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)

        <tr>
            <td>{{ $category->title }}</td>
            <td>{{ $category->posts->count() }}</td>
            <td>
                {!! Form::open(['method'=>'DELETE','route'=>['categories.destroy',$category->id]]) !!}

                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info">
                    Edit
                </a>


                <button onclick="return confirm('Are U sure ?')" type="submit" class="btn btn-danger">
                    Delete
                </button>


                {!! Form::close() !!}


            </td>

        </tr>

    @endforeach
    </tbody>
</table>