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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	{{HTML::style(URL::asset('themes/'.Theme::name().'/views/css/bootstrap.min.css') );}}    <!-- Custom Fonts -->
	{{HTML::style(URL::asset('themes/'.Theme::name().'/views/css/animate.css') );}}    <!-- Custom Fonts -->
	{{HTML::style(URL::asset('themes/'.Theme::name().'/views/css/prettyPhoto.css') );}}    <!-- Custom Fonts -->
	{{HTML::style(URL::asset('themes/'.Theme::name().'/views/css/font-awesome.min.css') );}}    <!-- Custom Fonts -->
	{{HTML::style(URL::asset('themes/'.Theme::name().'/views/css/styles.css') );}}    <!-- Custom Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

	<body>
	<input type="hidden" id="base" value="{{URL::to('/')}}" />
	<header id="header">
        
        <!-- Main menu toggle -->
        <button class="toggle" data-toggle="modal" data-target="#menumodal">
            <span class="menu-bar bar-1"></span>
            <span class="menu-bar bar-2"></span>
            <span class="menu-bar bar-3"></span>
        </button>
        
        <!-- Second logo for mobiles/tablets only. Maximum height of 65px -->
        <div class="mobile_logo">
            <img src="{{URL::to('/')}}img/logo.png" alt="{{$config['blog_name']}}">
        </div>

        <!-- Bullet navigation -->
        <nav id="bullets" class="cover" style="height: 643px;">
            <ul>
            	@yield('menu')
            </ul>
        </nav>

    </header>
	
	
	<!--carousel -->

	<div class="wrapper">
    
		@yield('content')	
		<div id="footer">
			<div class="container">
				<p class="muted credit pull-right">&copy 2014 NoiaTech</p>
			</div>
		</div>	
				
	</div> <!--end of wrapper-->
 

	{{HTML::script(URL::asset('themes/'.Theme::name().'/views/js/jquery.js'));}}
	{{HTML::script(URL::asset('themes/'.Theme::name().'/views/js/bootstrap.js'));}}	
	{{HTML::script(URL::asset('themes/'.Theme::name().'/views/js/jquery.prettyPhoto.js'));}}	
	{{HTML::script(URL::asset('themes/'.Theme::name().'/views/js/wow.min.js'));}}
    {{HTML::script(URL::asset('themes/'.Theme::name().'/views/js/script.js'));}}

	
	<script>
	 new WOW().init();
	</script>
</body>

</html>
			