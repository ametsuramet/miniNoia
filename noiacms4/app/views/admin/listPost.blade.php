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
				   {{ $data['title'] }}<span class="caret"></span>
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
               				<th>Publish</th>
               				<th>Title</th>
               				@if($data['type']=="post")
               				<th>Category</th>
							<th>Hit</th>
               				@endif
							
               				<th>Edit</th>
               			</tr>
               		</thead>
               		<tbody>
               			@foreach($data['post'] as $index=>$post)
               			
               			<tr>
               				<td>{{$index+1}}</td>               				
               				<td>
               					@if($post->flag=="publish")
               					{{date('d-M-y G:i:s', strtotime($post->publish))}} 
               					@endif
               				</td>
							<?php $type="" ?>						
							<?php if(isset($_GET['type'])) $type = "?type=".$_GET['type'] ?>
               				
               				@if($data['type']=="post")
							<td><a href="{{URL::to('/article')}}/{{$post->cat_item->slug}}/{{$post->slug}}{{$type}}">{{$post->title}}</a></td>
				
               				<td><a href="{{URL::to('/category')}}/{{$post->cat_item->slug}}">{{$post->cat_item->name}}</a></td>
							<td>{{$post->hit}}</td>
							@elseif($data['type']=="page")
							<td><a href="{{URL::to('/page')}}/{{$post->slug}}{{$type}}">{{$post->title}}</a></td>
							@else
               				@endif
               				@if($data['type']=="post")
               				<td>
               					<a href="{{URL::to('/')}}/admin?id={{$post->id}}&mode=edit"><i class="fa fa-edit"></i> </a>    
               					<a href="{{URL::to('/')}}/admin?id={{$post->id}}&mode=delete"><i class="fa fa-trash-o"></i> </a>     
               				</td>
               				@else
               				<td>
               					<a href="{{URL::to('/')}}/addPage?id={{$post->id}}&mode=edit"><i class="fa fa-edit"></i> </a>    
               					<a href="{{URL::to('/')}}/addPage?id={{$post->id}}&mode=delete"><i class="fa fa-trash-o"></i> </a>     
               				</td>
               				@endif
               				
               			</tr>
               			@endforeach
               		</tbody>
               	</table>
            </div>
        </div>
    </div>

@stop

