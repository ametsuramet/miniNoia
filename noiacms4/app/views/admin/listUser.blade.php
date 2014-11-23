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
				  User<span class="caret"></span>
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
               	<table class="table table-hover">
               		<thead>
               			<tr>
               				<th>No</th>
               				
               				<th>Name</th>
               				<th>Username</th>
               				<th>Email</th>
               				
               				<th>Edit</th>
               			</tr>
               		</thead>
               		<tbody>
               			
               			@foreach($data as $index=>$user)
               			
               			<tr>
               				<td>{{$index+1}}</td>               				
               				
               				<td>{{$user->name}}</td>
               				<td>{{$user->username}}</td>
               				<td>{{$user->email}}</td>
               				
               				<td>
               					<a href="/addUser?id={{$user->id}}&mode=edit"><i class="fa fa-edit"></i> </a>    
               					<a href="/addUser?id={{$user->id}}&mode=delete"><i class="fa fa-trash-o"></i> </a>     
               				</td>
               				
               				
               			</tr>
               			@endforeach
               		</tbody>
               	</table>
            </div>
        </div>
    </div>

@stop
