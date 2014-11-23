@section('content')

<div id="page-wrapper">
	<div class="col-lg-12">
					<?php  if(Session::has('flash_notice')): ?>
						<div id="flash_notice"><?php echo Session::get('flash_notice') ?></div>
					 <?php endif; ?>
               
                </div>
				
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
					Setting
					</h1>
					<blockquote>
						Setting dapat diubah dalam file noiacms4/config/blog.php
					</blockquote>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
				 <div class="col-md-2">
					{{Form::label('','List Item')}}
				</div>
				<div class="col-md-8">
					{{$config['list_item']}}	
				</div>
			</div>
			<div class="row">
				 <div class="col-md-2">
					{{Form::label('','Author')}}
				</div>
				<div class="col-md-8">
					{{$config['author']}}						
				</div>
			</div>
			<div class="row">
				 <div class="col-md-2">
					{{Form::label('','Blog Name')}}
				</div>
				<div class="col-md-8">
					{{$config['blog_name']}}						
				</div>
			</div>
			<div class="row">
				 <div class="col-md-2">
					{{Form::label('','Description')}}
				</div>
				<div class="col-md-8">
					{{$config['description']}}						
				</div>
			</div>
			<div class="row">
				 <div class="col-md-2">
					{{Form::label('','Tag Line')}}
				</div>
				<div class="col-md-8">
					{{$config['tag_line']}}						
				</div>
			</div>
			<div class="row">
				 <div class="col-md-2">
					{{Form::label('','Keyword')}}
				</div>
				<div class="col-md-8">
					{{$config['keyword']}}						
				</div>
			</div>
			<div class="row">
				 <div class="col-md-2">
					{{Form::label('','Alias')}}
				</div>
				<div class="col-md-8">
					{{$config['alias']}}						
				</div>
			</div>
			<div class="row">
				 <div class="col-md-2">
					{{Form::label('','Avatar')}}
				</div>
				<div class="col-md-4">
					<img src="{{$config['avatar']}}">				
				</div>
			</div>
			<div class="row">
				 <div class="col-md-2">
					{{Form::label('','Comment')}}
				</div>
				<div class="col-md-8">
					@if($config['comment'])
					<i class="fa fa-check-square-o"></i>
					@else
					<i class="fa fa-times"></i>
					@endif
				</div>
			</div>
			<div class="row">
				 <div class="col-md-2">
					{{Form::label('','Menu')}}
				</div>
				<div class="col-md-4">
					<ul>
						@foreach($config['menu'] as $name=>$menu)
						<li>{{$name}}</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="row">
				 <div class="col-md-2">
					{{Form::label('','Menu Admin')}}
				</div>
				<div class="col-md-4">
					<ul>
					@foreach($config['menu_admin'] as $name=>$menu)
						<li>{{$name}}
						@if(isset($menu[2]))
						 <ul class="nav nav-second-level">
							 @foreach($menu[2] as $name2=>$menu2)
								<li><i class="fa fa-chevron-right"></i> {{$name2}} </li>
							 @endforeach
						</ul>
						@endif
						</li>
					@endforeach	
					</ul>
				</div>
			</div>
			<div class="row">
				 <div class="col-md-2">
					{{Form::label('','Twitter')}}
				</div>
				<div class="col-md-4">
					{{$config['twitter']}}			
				</div>
			</div>
			<div class="row">
				 <div class="col-md-2">
					{{Form::label('','Facebook')}}
				</div>
				<div class="col-md-4">
					{{$config['facebook']}}			
				</div>
			</div>
			<div class="row">
				 <div class="col-md-2">
					{{Form::label('','Google+')}}
				</div>
				<div class="col-md-4">
					{{$config['google+']}}			
				</div>
			</div>
</div>
@stop