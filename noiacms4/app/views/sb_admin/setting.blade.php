@section('content')
<style>
.form-setting{
margin-bottom:10px;
}
</style>
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
                </div>
                <!-- /.col-lg-12 -->
            </div>
			{{Form::open(array('url' => '/saveSetting?action=save', 'method' => 'post','files' => true))}}
            <div class="row form-setting">
				 <div class="col-md-2">
					{{Form::label('','List Item')}}
				</div>
				<div class="col-md-8">					
					{{Form::text('list_item', $config_blog['list_item'] , array('class' => 'form-control'))}}							
				</div>
			</div>
			<div class="row form-setting">
				 <div class="col-md-2"> 
					{{Form::label('','Author')}}
				</div>
				<div class="col-md-8">
					{{Form::text('author', $config_blog['author'] , array('class' => 'form-control'))}}			
				</div>
			</div>
			<div class="row form-setting">
				 <div class="col-md-2">
					{{Form::label('','Blog Name')}}
				</div>
				<div class="col-md-8">
					{{Form::text('blog_name', $config_blog['blog_name'] , array('class' => 'form-control'))}}		
				</div>
			</div>
			<div class="row form-setting">
				 <div class="col-md-2">
					{{Form::label('','Description')}}
				</div>
				<div class="col-md-8">
					{{Form::textarea('description', $config_blog['description'] , array('class' => 'form-control'))}}	
				</div>
			</div>
			<div class="row form-setting">
				 <div class="col-md-2">
					{{Form::label('','Tag Line')}}
				</div>
				<div class="col-md-8">
					{{Form::text('tag_line', $config_blog['tag_line'] , array('class' => 'form-control'))}}					
				</div>
			</div>
			<div class="row form-setting">
				 <div class="col-md-2">
					{{Form::label('','Keyword')}}
				</div>
				<div class="col-md-8">
					{{Form::textarea('keyword', $config_blog['keyword'] , array('class' => 'form-control'))}}		
				</div>
			</div>
			<div class="row form-setting">
				 <div class="col-md-2">
					{{Form::label('','Alias')}}
				</div>
				<div class="col-md-8">
					{{Form::text('alias', $config_blog['alias'] , array('class' => 'form-control'))}}							
				</div>
			</div>
			<div class="row form-setting">
				 <div class="col-md-2">
					{{Form::label('','Avatar')}}
				</div>
				<div class="col-md-4">
					<img src="{{$config_blog['avatar']}}">		
					{{Form::file('avatar', array('class' => 'form-control'))}}	
					{{Form::hidden('avatar2',$config_blog['avatar'],array('class' => 'form-control'))}}	
				</div>
			</div>
			<div class="row form-setting">
				 <div class="col-md-2">
					{{Form::label('','Comment')}}
				</div>
				<div class="col-md-8">
					{{Form::checkbox('comment', 'true', $config_blog['comment'], array())}}
				</div>
			</div>
			<div class="row form-setting">
				 <div class="col-md-2">
					{{Form::label('','Menu')}}
				</div>
				<div class="col-md-2">
					<i class="fa fa-plus  add_menu" style="cursor:pointer;font-size:1.2em;color:#f00"></i>
				</div>
			</div>
				<span class="setting_menu">
				@foreach($config_blog['menu'] as $name=>$menu)
				<div class="row form-setting"> 
					<div class="col-md-2">
					</div>
					<div class="col-md-4">
						{{Form::text('menu[name][]',$name, array('class' => 'form-control'))}}						
					</div>
					<div class="col-md-4">
						{{Form::text('menu[link][]',$menu, array('class' => 'form-control'))}}						
					</div>
					<div class="col-md-2">
						<i class="fa fa-times  del_menu" style="cursor:pointer;font-size:1.2em;color:#f00"></i>
					</div>
				</div>
				@endforeach
				</span>
		
			<div class="row form-setting">
				 <div class="col-md-2">
					{{Form::label('','Twitter')}}
				</div>
				<div class="col-md-4">
					{{Form::text('twitter',$config_blog['twitter'], array('class' => 'form-control'))}}		
				</div>
			</div>
			<div class="row form-setting">
				 <div class="col-md-2">
					{{Form::label('','Facebook')}}
				</div>
				<div class="col-md-4">
					{{Form::text('facebook',$config_blog['facebook'], array('class' => 'form-control'))}}			
				</div>
			</div>
			<div class="row form-setting">
				 <div class="col-md-2">
					{{Form::label('','Google+')}}
				</div>
				<div class="col-md-4">
					{{Form::text('google+',$config_blog['google+'], array('class' => 'form-control'))}}			
				</div>
			</div>
			<div class="row form-setting">
				<div class="form-group">
				    	{{Form::submit('Submit!', array('class' => 'btn submit'))}}	    
				</div>
			</div>
			{{Form::close()}}
</div>
@stop