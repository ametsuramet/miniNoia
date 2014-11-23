@section('content')


    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
 	<header class="intro-header" style="background-image: url({{URL::asset('img/post-bg.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Login</h1>
                        <hr class="small">
                        <span class="subheading">Silakan login terlebih dahulu</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-g-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            	 <?php  if(Session::has('flash_notice')): ?>
	                <div id="flash_notice"><?php echo Session::get('flash_notice') ?></div>
	            <?php endif; ?>
               {{Form::open(array('url' => '/login', 'method' => 'post'))}}
               {{Form::label('id', 'Username')}}
               {{Form::text('username')}}
               {{Form::label('id', 'Password')}}
               {{Form::password('password')}}
               {{Form::submit('Submit!', array('class' => 'submit'))}}
               {{Form::close()}}
            </div>
        </div>
    </div>

@stop

