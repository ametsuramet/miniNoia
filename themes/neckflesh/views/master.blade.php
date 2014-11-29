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
	{{HTML::style(URL::asset('themes/'.Theme::name().'/views/css/bootstrap.min.css') );}}    <!-- Custom Fonts -->
	{{HTML::style(URL::asset('themes/'.Theme::name().'/views/css/style.css') );}}    <!-- Custom Fonts -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

	<body>
	<input type="hidden" id="base" value="{{URL::to('/')}}" />
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div id="logo">
					<img src="{{Theme::asset('views/img/logo.png')}}">
				</div>
			</div>	
		</div>	
		<header>
			<div class="row">
			<nav class="navbar navbar-inverse navbar-default" role="navigation">
		      <!-- Brand and toggle get grouped for better mobile display -->
		      <div class="navbar-header">
		        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		          <span class="sr-only">Toggle navigation</span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		        </button>
		      </div>
			
		      <!-- Collect the nav links, forms, and other content for toggling -->
		      <div class="collapse navbar-collapse navbar-ex1-collapse">
		        <ul class="nav navbar-nav">
		        	<li><a href="{{URL::to('/')}}"><i class="fa fa-home"></i> </a></li>
		        	@foreach($config['menu'] as $index=>$name)
		          	
		          	@if(isset($config['menu_child1'][$index]))
		          	<li class="dropdown">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{$index}} <b class="caret"></b></a>
		            <ul class="dropdown-menu">
		          		@foreach($config['menu_child1'][$index] as $index_child1=>$name_child1)
		          			<li><a href="{{URL::to('/')}}/{{$name_child1}}">{{$index_child1}}</a></li>
		          		@endforeach
		          	</ul>
		          	@else
		          	<li>
		          	<a href="{{URL::to('/')}}/{{$name}}">{{$index}}</a>
		          	@endif
		         	@endforeach
		         	</li>
		          <!--*<li class="dropdown">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <b class="caret"></b></a>
		            <ul class="dropdown-menu">
		              <li><a href="#">Action</a></li>
		              <li><a href="#">Another action</a></li>
		              <li><a href="#">Something else here</a></li>
		              <li><a href="#">Separated link</a></li>
		              <li><a href="#">One more separated link</a></li>
		            </ul>
		          </li>-->
		          <li><a href="#"><i class="fa fa-search search_btn"></i></a></li>
		          <li><input id="search_input" class="form-control"/></li>
		        </ul>
		      </div><!-- /.navbar-collapse -->
		    </nav>
		     </div>
		</header>	
	</div>
	@yield('content')
	
    <footer class="container-fluid">
      <div class="container">
      	<div class="row">
      		<div class="col-md-3">
      			<h4 class="module_title2">Information</h4>
      			<ul>
					
				</ul>
				<ul class="links">
					<li><i class="fa  fa-angle-right"></i> <a href="{{URL::to('/')}}">About Us</a></li>
					<li><i class="fa  fa-angle-right"></i> <a href="{{URL::to('/')}}contact" title="Contact Us">Contact Us</a></li>
					<li><i class="fa  fa-angle-right"></i> <a href="#" title="Store Locator">Store Locator</a></li>
					<li><i class="fa  fa-angle-right"></i> <a href="#" title="Reseller Inquiries">Reseller Inquiries</a></li>
					<li><i class="fa  fa-angle-right"></i> <a href="#" title="Payment">Payment</a></li>
				</ul>
      		</div>
      		<div class="col-md-3">
      			<h4 class="module_title2">Sitemaps</h4>
      			<ul class="links">
      			@foreach($config['menu'] as $index=>$name)
		          	
	          	@if(isset($config['menu_child1'][$index]))
	          	<li> <i class="fa  fa-angle-right"></i> 
	            <a href="#">{{$index}}</b></a>
	            <ul class="links">
	          		@foreach($config['menu_child1'][$index] as $index_child1=>$name_child1)
	          			<li><i class="fa  fa-angle-right"></i> <a href="{{$name_child1}}">{{$index_child1}}</a></li>
	          		@endforeach
	          	</ul>
	          	@else
	          	<li> <i class="fa  fa-angle-right"></i> 
	          	<a href="{{$name}}">{{$index}}</a>
	          	@endif
	         	@endforeach
	         	</li>
	         	</ul>
      		</div>
      		<div class="col-md-3">
      			<h4 class="module_title2">Latest Articles</h4>
      			<ul class="links">
      				@foreach($module['post'] as $modul_post)
					<li><i class="fa  fa-angle-right"></i> <a href="{{URL::to('/')}}/article/{{$modul_post->cat_item->slug}}/{{$modul_post->slug}}">{{$modul_post->title}}</a></li>
					@endforeach
				</ul>
      		</div>
      		<div class="col-md-3">
      			<h4 class="module_title2">Contact Us</h4>
      			<address>Jl. Cigondewah 133 - Bandung</address>
      			
      		</div>
      	</div>
      	<div class="row">
      		<div class="col-md-12">
      			<p class="credit">&copy 2014 - Neckflesh - All Rights Reserved</p>
      		</div>      			
      	</div>
      </div>
    </footer>
  
 

	{{HTML::script(URL::asset('themes/'.Theme::name().'/views/js/jquery.js') );}}
	{{HTML::script(URL::asset('themes/'.Theme::name().'/views/js/bootstrap.js') );}}
		 <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	{{HTML::script(URL::asset('themes/'.Theme::name().'/views/js/jquery.elevateZoom-3.0.8.min.js') );}}
    {{HTML::script(URL::asset('themes/'.Theme::name().'/views/js/script.js') );}}


</body>

</html>
			