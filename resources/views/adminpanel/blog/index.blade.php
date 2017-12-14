@extends('layouts.adminpanel.main')

@section('title', 'MyBlog | Blog index')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{--<section class="content-header">
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li><a href="{{route('blog.index')}}">Blog</a></li>
                <li class="active">All Posts</li>
            </ol>
        </section>--}}

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12 col-sm-offset-0 col-md-12 col-md-offset-0">
                    <h1><i class="fa fa-database" aria-hidden="true"></i>
                         Posts Management</h1>
                    <br>
                    <div>
                        <div>


                            {{--<div class="pull-left">
                                <a href="{{route('blog.create')}}" class="btn btn-success fa fa-plus"> Add New</a>
                            </div>--}}


                      {{--status panel right side top--}}
                            <div class="pull-right post-info">
                                <?php $links = [] ?>
                                @foreach($statusList as $key => $value)
                                   @if($value)
                                        <?php $selected = Request::get('status')== $key ? 'seleceted-status': ''?>
                                       <?php $links[]= "<a class=\"{$selected}\" href=\"?status={$key}\">".ucwords($key)."({$value})</a>"?>
                                   @endif
                                @endforeach

                                {!! implode(' | ', $links) !!}

                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class=" ">

                            @include('adminpanel.info-message.message')


                            @if(! $posts->count())
                            <div class="alert alert-danger">
                                <strong>No record found</strong>
                            </div>

                            @else
                                @if($onlyTrashed)
                                    @include('adminpanel.blog.table-trash')

                                 @else
                                    @include('adminpanel.blog.table')

                                 @endif
                            @endif
                        </div>
                        <!-- /.box-body -->
                        <div class="footer clearfix">
                            <div class="pull-left">
                                {{ $posts->appends(Request::query())->render() }}
                            </div>
                            <div class="pull-right">

                                <small>{{ $postCount }} {{ str_plural('Item', $postCount) }}</small>
                            </div>
                        </div>
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

    <script type="text/javascript">

        $('ul.pagination').addClass('no-margin pagination-sm')

    </script>
@endsection