<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NoiaCMS4 - mini version</title>
	{{HTML::style(URL::asset('css/bootstrap.min.css'));}}
	{{HTML::style(URL::asset('css/plugins/metisMenu/metisMenu.min.css'));}}
	{{HTML::style(URL::asset('css/plugins/timeline.css'));}}
	{{HTML::style(URL::asset('css/sb-admin-2.css'));}}
	{{HTML::style(URL::asset('css/plugins/morris.css'));}}
	{{HTML::style(URL::asset('css/font-awesome.min.css'));}}
   
	{{HTML::style(URL::asset('css/prettify.css') );}}

	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.min.css" />
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.min.css" />
	{{HTML::style('http://cdnjs.cloudflare.com/ajax/libs/summernote/0.5.2/summernote.css');}}
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<style>
#flash_notice{
padding: 10px;
background: #FDFDCC;
margin: 20px;
font-style: italic;
}
</style>
    <div id="wrapper">

        <!-- Navigation -->
		@if (!Auth::guest())
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">NoiaCMS4 - Mini Version</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> {{Auth::user()->username}}</a>
                        </li>
                        <li><a href="{{URL::to('/setting')}}"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{URL::to('/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a class="active" href="{{URL::to('/admin')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        @foreach($config['menu_admin'] as $name=>$menu)
						 <li><a href="{{URL::to('/')}}{{$menu[0]}}">{{$menu[1]}}</i> {{$name}} </a>
						 @if(isset($menu[2]))
						 <ul class="nav nav-second-level">
							 @foreach($menu[2] as $name2=>$menu2)
								<li><a href="{{URL::to('/')}}{{$menu2[0]}}">{{$menu2[1]}}</i> {{$name2}} </a></li>
							 @endforeach
						</ul>
						@endif
						 </li>
						@endforeach
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
		@endif
		 @yield('content')
      
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
	{{HTML::script(URL::asset('js/jquery.js'));}}
	{{HTML::script(URL::asset('js/bootstrap.min.js'));}}
	{{HTML::script(URL::asset('js/plugins/metisMenu/metisMenu.min.js'));}}
	<!--{{HTML::script(URL::asset('js/plugins/morris/raphael.min.js'));}}
	{{HTML::script(URL::asset('js/plugins/morris/morris.min.js'));}}
	{{HTML::script(URL::asset('js/plugins/morris/morris-data.js'));}}-->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.min.js"></script>
	{{HTML::script('http://cdnjs.cloudflare.com/ajax/libs/summernote/0.5.2/summernote.min.js');}}  

    {{HTML::script(URL::asset('js/prettify.js') );}}
    {{HTML::script(URL::asset('js/miniNoia.js') );}}	
	{{HTML::script(URL::asset('js/sb-admin-2.js'));}}
    

</body>

</html>
