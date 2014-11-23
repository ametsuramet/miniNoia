@section('content')


    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
 	<header class="intro-header" style="background-image: url({{URL::asset('img/post-bg.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Dashboard</h1>
                        <hr class="small">
                        <span class="subheading">Halaman Admin</span>
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
               	<!-- Single button -->
				<div class="btn-group">
				  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
				    Add Page <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu" role="menu">
				    @foreach($config['menu_admin'] as $name=>$menu)
					 <li><a href="{{URL::to('/')}}{{$menu[0]}}">{{$menu[1]}}</i> {{$name}} </a></li>
					@endforeach
				    <li class="divider"></li>
				    <li><a href="{{URL::to('/logout')}}"><i class="fa  fa-sign-out"></i> Logout</a></li>
				  </ul>
				</div>
				<br>
				<br>
				<br>
               	{{Form::open(array('url' => '/addPage', 'method' => 'post'))}}
               	
               	<div class="form-group">
               		{{Form::hidden('id', $data['post_edit']->id)}}
			    	{{Form::label('id', 'Title')}}
					{{Form::text('title', $data['post_edit']->title , array('class' => 'form-control'))}}		    	
			    </div>
              	<div class="form-group">
			    	{{Form::label('id', 'Description')}}
					{{Form::textarea('desc', $data['post_edit']->description , array('class' => 'form-control','id'=>'summernote','rows'=>25))}}		    	
			    </div>
			     <div class="form-group">
				    	{{Form::label('id', 'Status')}}
				    	
						{{Form::select('status', array('draft'=>'Draft','publish'=>'Publish'), $data['post_edit']->flag , array('class' => 'form-control '))}}			    	
				    </div>
				<div class="form-group">
				    	{{Form::submit('Submit!', array('class' => 'btn submit'))}}	    
				</div>
			     
              	
               	{{Form::close()}}
            </div>
        </div>
    </div>
@stop


