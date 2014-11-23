<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{$config['description']}}">
    <meta name="keywords" content="{{$config['keyword']}}">
    <meta name="author" content="{{$config['author']}}">
	<meta content='id' name='language'/>
    <meta content='id' name='geo.country'/>
    <meta content='global' name='distribution'/>
    <meta content='Indonesia' name='geo.placename'/>
    <meta content='noindex, nofollow' name='robots'/>
    <meta content='general' name='rating'/>
 
	<meta property="og:site_name" content="prothelon.com" />
	<meta property="og:type" content="article" /> 
	<meta property="og:locale" content="id_ID" />
	<meta property="og:url" content="@yield('meta_url')" />
	<meta property="og:title" content="@yield('meta_title')" />
	<meta property="og:description" content="{{$config['description']}}" />
	<meta property="article:published_time" content="@yield('meta_publish')" />
	<meta property="article:modified_time" content="@yield('meta_update')" />
	<meta property="article:author" content="{{$config['author']}}" />
	<meta property="article:section" content="@yield('meta_section')" />
	<meta property="article:tag" content="@yield('meta_tag')" />
    <title>@yield('meta_title')</title>
	<link rel="icon" type="image/jpeg" href="{{$config['avatar']}}" />


	{{HTML::style(URL::asset('themes/'.Theme::name().'/views/css/bootstrap.min.css') );}}
	{{HTML::style(URL::asset('themes/'.Theme::name().'/views/css/clean-blog.min.css') );}}
	{{HTML::style(URL::asset('themes/'.Theme::name().'/views/css/prettify.css') );}}
	{{HTML::style(URL::asset('themes/'.Theme::name().'/views/css/default.css') );}}
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.min.css" />
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.min.css" />
	{{HTML::style('http://cdnjs.cloudflare.com/ajax/libs/summernote/0.5.2/summernote.css');}}
   
 
 
    <!-- Custom Fonts -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56996079-1', 'auto');
  ga('send', 'pageview');

</script>	
 
</head>

<body>


    
<input type="hidden" id="base" value="{{URL::to('/')}}" />
	<style>
		#flash_notice{
			padding:20px;
			background-color: #ff0;
			margin-bottom:20px;
		}
		.comment div{
			padding:10px;
			-webkit-transition: all 1s; /* For Safari 3.1 to 6.0 */
   			 transition: all 1s;
		}
		.comment div:hover{
			background:rgba(0,0,0,0.2)
		}
		.comment{
			
			font-size:0.6em;
		}
		.comment div h4{
			padding-bottom:5px;
			margin-bottom:0.2em
			
		}
		.comment p{
			margin-top:0.2em
			
		}
		
	</style>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">{{Config::get('blog.alias')}}</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
					<li><a href="#"><input class="form-control search_wrapper" placeholder="Search here...." style="
						display:none;
						font-weight: normal;
						font-size: 0.9em;
						margin: 0;
						height: 20px;
					"> </a></li>
					<li><a href="#"><i class="fa fa-search show_search"></i></a></li>
                    <li>
                        <a href="{{URL::to('/')}}">Home</a>
                    </li>
                    @foreach(Config::get('blog.menu') as $name=>$link)
					<li>
                        <a href="/{{$link}}">{{$name}}</a>
                    </li>
                    @endforeach
                    
                    
                   
                    	@if (Auth::guest())
                    	 <li>
                        <a href="{{URL::to('/admin')}}"><i class="fa fa-sign-in"></i></a>
                        @else
                        <li>
                        <a href="{{URL::to('/admin')}}"><i class="fa fa-laptop"></i></a>
                          </li>
                         <li>
                        <a href="{{URL::to('/logout')}}"><i class="fa fa-sign-out"></i></a>
                          </li>
                        @endif
                  
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
		
    	  @yield('content')
    	
    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
            
            <a href="http://api.idhostinger.com/redir/5037416" target="_blank">
<img src="http://www.idhostinger.com/banners/id/hostinger-728x90-1.gif" alt="Hosting Gratis" border="0" width="728" height="90" style="
    display: block;
    margin: auto auto 20px;
">
</a>
            </div>
            <div class="row">
              	
					<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
					    <ul class="list-inline text-center">
					        <li>
					            <a href="https://twitter.com/{{Config::get('blog.twitter')}}">
					                <span class="fa-stack fa-lg">
					                    <i class="fa fa-circle fa-stack-2x"></i>
					                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
					                </span>
					            </a>
					        </li>
					        <li>
					            <a href="https://facebook.com/{{Config::get('blog.facebook')}}">
					                <span class="fa-stack fa-lg">
					                    <i class="fa fa-circle fa-stack-2x"></i>
					                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
					                </span>
					            </a>
					        </li>
					        <li>
					            <a href="https://plus.google.com/+{{Config::get('blog.google+')}}">
					                <span class="fa-stack fa-lg">
					                    <i class="fa fa-circle fa-stack-2x"></i>
					                    <i class="fa fa-google fa-stack-1x fa-inverse"></i>
					                </span>
					            </a>
					        </li>
					    </ul>
					   <p class="copyright text-muted">Copyright &copy; 2014  {{Config::get('blog.alias')}} </p>
					</div>
            </div>
        </div>
    </footer>
  
 

	{{HTML::script(URL::asset('themes/'.Theme::name().'/views/js/jquery.js') );}}
	{{HTML::script(URL::asset('themes/'.Theme::name().'/views/js/bootstrap.js') );}}
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.min.js"></script>
	{{HTML::script('http://cdnjs.cloudflare.com/ajax/libs/summernote/0.5.2/summernote.min.js');}}
  
    {{HTML::script(URL::asset('themes/'.Theme::name().'/views/js/clean-blog.js') );}}
    {{HTML::script(URL::asset('themes/'.Theme::name().'/views/js/prettify.js') );}}
    {{HTML::script(URL::asset('themes/'.Theme::name().'/views/js/miniNoia.js') );}}


</body>

</html>
			