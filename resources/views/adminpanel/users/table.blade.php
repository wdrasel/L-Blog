<table class="table table-bordered table-inverse table-striped">
    <thead>
    <tr>
        <td>Name</td>
        <td>Email</td>
        <td>User Role</td>
        <td width="200">Operations</td>
    </tr>
    </thead>
    <tbody>
    <?php $currentUser = auth()->user();?>
    @foreach($users as $user)

        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{$user->roles->first()->display_name}}</td>
            <td>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">
                    Edit
                </a>
                @if($user->id == 1 || $user->id == $currentUser->id)

                    <button onclick="return false" type="submit" class=" btn btn-danger">
                        UnDelete
                    </button>
                @else
                <a href="{{route('users.confirm',$user->id)}}" class="btn btn-danger">
                    Delete
                </a>
                @endif


            </td>


        </tr>

    @endforeach
    </tbody>
</table>