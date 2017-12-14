@extends('layouts.adminpanel.main')

@section('title', 'MyBlog | Dlete Confirmation')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blog
                <small>Delete Confirmation</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li><a href="{{route('users.index')}}">Users</a></li>

                <li class="active">Delete confirmation</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12 box ">
                    <div class=" col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 ">
                        <!-- /.box-header -->
                        <div class="box-body justify-content-md-center">
                        </div>
                        <!-- /.box-body -->
                        {!! Form::model($user,[

                                        'method'=>'DELETE',
                                        'enctype' =>"multipart/form-data",
                                        'route'=>['users.destroy',$user->id]

                                         ])!!}


                        <p>You have specified this user for deletion</p>
                        <p>
                            ID # {{$user->id}}: {{$user->name}}
                        </p>
                        <p>
                            what should be done with content owned by this user?
                        </p>
                        <p>
                            <input type="radio" name="delete_option" value="delete" checked> Delete all content
                        </p>
                        <p>
                            <input type="radio" name="delete_option" value="attribute"> attribute content to

                            {!! Form::select('seleceted_user',$users,null) !!}

                        </p>


                        <div class="box-footer">

                            <button type="submit" class="btn btn-danger">Confirm Deletion</button>
                            <a href="{{route('users.index')}}">Cancel</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>

@endsection
