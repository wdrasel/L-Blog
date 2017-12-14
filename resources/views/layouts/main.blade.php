
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyBlog | My Awesome Blog</title>


    <link href='https://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">

   <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/custom.css">


</head>
<body>
     <!--page loading-->

    <header>

        <nav class="navbar navbar-default navbar-inverse" id="navbar">
            <div class="container">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"><img src="\logo\laraexpart2.png" alt=""></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav" id="navbar-nav">
                            <li><a href="{{route('blog')}}">Home</a></li>
                            <li><a href="{{route('blog.list')}}">All News</a></li>
                            <li><a href="{{url('/about')}}">About</a></li>

                        </ul>



                        {{--<div class="">
                            <a href="#"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>
                            <a href="#"><i id="social-tw" class="fa fa-twitter-square fa-3x social"></i></a>
                            <a href="#"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a>
                            <a href="#"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>
                        </div>--}}


                        <form class="navbar-form navbar-right" id="navbar-form" action="{{route('blog')}}">
                            <div class="input-group">
                                <input style="background-color: #777;border-color: #0f0f0f" type="text" class="form-control input-lg" value="{{request('term')}}" name="term" placeholder="Search for...">
                                <span class="input-group-btn">
                        <button style="background-color: #777;border-color: #0f0f0f" class="btn btn-lg btn-default" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                            </div>
                        </form>

                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </div>
        </nav>
    </header>

    @yield('content')



    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.4.min.js"></script>
     <script >
         var hei = $( window ).height()-135;
         $('.about-section').css('height', hei+'px');
         $('.page-not-found').css('height', hei+'px');
     </script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



    <!-- Optional theme -->
    {{--<script src="/js/bootstrap.min.js"></script>--}}
    {{--<script src="https://unpkg.com/vue"></script>--}}
</body>
<footer>
    <div class="container ">
        <div class="row">
            <div class="col-md-8">
                <p class="copyright">&copy; 2017 Lara Expart v.1</p>
            </div>
            <div class="col-md-4">
                <nav>
                    <ul class="social-icons">
                        <li><a href="#" class="i fa fa-facebook"></a></li>
                        <li><a href="#" class="i fa fa-twitter"></a></li>
                        <li><a href="#" class="i fa fa-google-plus"></a></li>
                        <li><a href="#" class="i fa fa-github"></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</footer>
</html>
