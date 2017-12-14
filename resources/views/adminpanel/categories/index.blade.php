@extends('layouts.adminpanel.main')

@section('title', 'MyBlog | Blog index')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ol class="breadcrumb">
                {{--<li>
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li><a href="{{route('categories.index')}}">Categories</a></li>
                <li class="active">All Categories</li>--}}
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-1 col-md-8 col-md-offset-1">
                    <div class="clearfix"><h1><i class="fa fa-list" aria-hidden="true"></i>
                            Categories</h1><br>
                    </div>
                    <div class="box">
                        <div class="box-header">

                            <div class="pull-right">

                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body ">

                            @include('adminpanel.info-message.message')


                            @if(! $categories->count())
                            <div class="alert alert-danger">
                                <strong>No record found</strong>
                            </div>

                            @else
                                @include('adminpanel.categories.table')
                            @endif
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                {{ $categories->appends(Request::query())->render() }}
                            </div>
                            <div class="pull-right">

                                <small>{{ $categoriesCount }} {{ str_plural('Item', $categoriesCount) }}</small>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->
                    <div class="pull-left">
                        <a href="{{route('categories.create')}}" class="btn btn-success fa fa-plus"> Add New</a>
                    </div>
                </div>
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>

@endsection

@section('script')

    <script type="text/javascript">

        $('ul.pagination').addClass('no-margin pagination-sm')

    </script>
@endsection