@extends('layouts.adminpanel.main')

@section('title', 'MyBlog | Add new post')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blog
                <small>Add new Category</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li><a href="{{route('categories.index')}}">Categories</a></li>

                    <li class="active">Add new</li>
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
                        {!! Form::model($category,[

                                        'method'=>'POST',
                                        'enctype' =>"multipart/form-data",
                                        'route'=>'categories.store',
                                        'files'=> TRUE ,
                                        'id'=> 'category-form' ]) !!}


                            @include('adminpanel.categories.form')

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

@section('script')

@include('adminpanel.categories.script')

@endsection