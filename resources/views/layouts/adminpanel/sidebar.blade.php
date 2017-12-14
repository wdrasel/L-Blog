

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <?php $currentUser = Auth::user() ?>
            <div class="pull-left image">
                <img src="{{$currentUser->gravatar()}}" class="img-circle" alt="{{$currentUser->name}}">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-cogs" aria-hidden="true"></i>
                    {{$currentUser->roles->first()->display_name}}</a>
            </div>
        </div>



        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a href="{{'/admin'}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <hr id="hr">

            <li><a href="{{ route('blog.create')}}"><i class="fa fa-plus-square"></i> <span>Create Post</span></a></li>
            <li><a href="{{ route('blog.index')}}"><i class="fa fa-list-alt"></i> All Posts</a></li>
            <li><a href="{{route('blog.index')}}?status=published"><i class="fa fa-newspaper-o"></i> <span>Published Posts</span></a></li>
            <li><a href="{{route('blog.index')}}?status=scheduled"><i class="fa fa-bolt"></i> <span>Scheduled</span></a></li>
            <li><a href="{{route('blog.index')}}?status=draft"><i class="fa fa-suitcase"></i> <span>Draft</span></a></li>

            <hr id="hr">

            @if (check_user_permissions(request(),"Categories@index"))
            <li><a href="{{ route('categories.create')}}"><i class="fa fa-plus-square"></i> <span>Create Category</span></a></li>
            <li><a href="{{route('categories.index')}}"><i class="fa fa-folder"></i> <span>Categories</span></a></li>
            @endif
            <hr id="hr">

            @if(check_user_permissions(request(),"users@index"))
            <li><a href="{{ route('users.create')}}"><i class="fa fa-plus-square"></i> <span>Create User</span></a></li>
            <li><a href="{{route('users.index')}}"><i class="fa fa-user"></i> <span>Users</span></a></li>
            @endif
            <hr id="hr">


            <li><a href="{{route('blog.index')}}?status=trash"><i class="fa fa-trash-o"></i><span>Trash</span></a></li>
            <hr id="hr" color="red">

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>