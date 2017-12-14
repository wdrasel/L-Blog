@extends('layouts.adminpanel.main')

@section('title', 'MyBlog | Edit User')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                User
                <small>Edit User</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li><a href="{{route('users.index')}}">Users</a></li>

                <li class="active">Edit now</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class=" col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 ">
                        <!-- /.box-header -->
                        <div class="box-body justify-content-md-center">
                        </div>
                        <!-- /.box-body -->
                        {!! Form::model($user,['method'=>'PUT',
                                        'enctype' =>"multipart/form-data",
                                        'route'=>['users.update',$user->id],
                                        'files'=> TRUE ,
                                        'id'=> 'user-form'


                                        ]) !!}


                        @include('adminpanel.users.form')

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
