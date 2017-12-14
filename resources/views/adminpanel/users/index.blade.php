@extends('layouts.adminpanel.main')

@section('title', 'MyBlog | Blog index')

@section('content')

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">

                    <div class="clearfix"><h1><i class="fa fa-users" aria-hidden="true"></i>
                            User Administration</h1><br>
                    </div>

                    <div class="box">
                        <div class="box-header">

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body ">

                            @include('adminpanel.info-message.message')


                            @if(! $users->count())
                                <div class="alert alert-danger">
                                    <strong>No record found</strong>
                                </div>

                            @else
                                @include('adminpanel.users.table')
                            @endif
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                {{ $users->appends(Request::query())->render() }}
                            </div>
                            <div class="pull-right">

                                <small>{{ $usersCount }} {{ str_plural('Item', $usersCount) }}</small>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->
                    <div class="pull-left">
                        <a href="{{route('users.create')}}" class="btn btn-success fa fa-plus"> Add New</a>
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