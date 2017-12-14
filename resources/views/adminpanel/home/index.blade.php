@extends('layouts.adminpanel.main')

@section('title','Myblog | Dashbord')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                &nbsp;&nbsp;Dasbhboard
            </h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" id="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="body">
                        <!-- /.box-header -->
                        <div class="">

                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3>{{$usersCount}}</h3>

                                        <p>Total Users</p>
                                    </div>


                                    <div class="icon">
                                        <i class="ion-ios-people"></i>

                                    </div>
                                    <a href="{{route('users.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3>{{$categoriesCount}}</h3>

                                        <p>Total Catagories</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion-ios-pricetags-outline"></i>
                                    </div>
                                    <a href="{{route('categories.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h3>{{$postsCount}}</h3>

                                        <p>Total Posts</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion-ios-albums"></i>
                                    </div>
                                    <a href="{{route('blog.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-red">
                                    <div class="inner">
                                        <h3>{{$trashCount}}</h3>

                                        <p>Trash</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion-trash-a"></i>
                                    </div>
                                    <a href="{{route('blog.index')}}?status=trash" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
        <div style="margin-top: 12em">
            <span  style="margin-left: 1.8em;font-size: 1.2em; " class="label label-primary"><i class="fa fa-eye" aria-hidden="true"></i>

                    Last 2 weeks Page View</span>


            <div id="chart1" style="margin-bottom: 30px;"></div>
        </div>



                <script type="text/javascript">
                    function renderPie(data)
                    {
                        var chartData = [];

                        chartData.push(['Country', 'Requests']);

                        $.each(data, function(index, value){
                            console.log(value);
                            chartData.push({label: value.label, data: value.value});
                        });

                        var options = {
                            series: {
                                pie: {
                                    offset: {
                                        left: 10
                                    },
                                    show: true
                                }
                            },
                            grid: {
                                hoverable: true,
                            },
                            tooltip: true,
                            tooltipOpts: {
                                content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                                shifts: {
                                    x: 20,
                                    y: 0
                                },
                                defaultTheme: false
                            }
                        };

                        var chart = $.plot($("#plot1"), chartData, options);
                        chart.draw();
                    }

                    $(document).ready(function(){
                        $('#period_dropdown').on('change',function(){
                            $('#form_chart_filter').submit();
                        });

                        Morris.Line({
                            data: {!! json_encode($pageViews) !!},
                            element: 'chart1',
                            xkey: 'date',
                            ykeys: ['total'],
                            resize: true,
                            lineWidth: 2,
                            labels: ['Pages Views'],
                            lineColors: ['#1ab394'],
                            pointSize:5,
                            xLabels: "day"
                        });

                        renderPie({!! json_encode($pageViews) !!});
                    });
                </script>
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
