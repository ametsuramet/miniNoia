@section('content')
<style>
	.thumb_prod{
		
		
		position:relative;
	}
	.thumb_prod img{
		width:100%;
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
					{{ucfirst($_GET['type'])}}
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
			{{Form::open(array('url' => '/addModule', 'method' => 'post','files' => true))}}
               	
               	<div class="form-group">
			    	{{Form::hidden('id', $data['post_edit']->id)}}
			    	{{Form::hidden('type', $_GET['type'])}}
			    	{{Form::label('id', 'Title')}}
					{{Form::text('title', $data['post_edit']->title , array('class' => 'form-control'))}}			    	
			    </div>
				<div class="form-group">
			    
			    	{{Form::label('slug', 'Slug')}}
					{{Form::text('slug', $data['post_edit']->slug , array('class' => 'form-control'))}}			    	
			    </div>
              	<div class="form-group">
              		<?php $id="summernote"?>
              		@if($_GET['type']=="html")
              		<?php $id=$_GET['type']?>
              		@endif
			    	{{Form::label('id', 'Description')}}
					{{Form::textarea('desc', htmlspecialchars($data['post_edit']->description) , array('class' => 'form-control','id'=>$id,'rows'=>25))}}		    	
			    </div>
			  
			    
			    <div class="form-group">
			    
			    	{{Form::label('link', 'Link')}}
					{{Form::text('link', $data['post_option']['link'] , array('class' => 'form-control menu_link'))}}			    	
			    </div>
			    <div class="row">
			    <div class="col-md-3 thumb_prod">
				    <div class="form-group">			    
				    	{{Form::label('img', 'Thumbnail')}}
				    	@if($data['post_option']['img']!="")
				    	<img  src="{{URL::to('/img/'.$_GET['type'].'/')}}/{{$data['post_option']['img']}}">
				    	@endif
						{{Form::file('img', array('class' => 'form-control'))}}	
						{{Form::hidden('img_hidden',$data['post_option']['img'],array('class' => 'form-control'))}}			    	
				    </div>
				    <i class="fa fa-times  del_thumb" style="cursor:pointer;font-size:1.2em;color:#f00;position:relative;margin:5px auto;text-align:center;display:block"></i>
			    </div>
			  
			    </div>	
			    <div class="form-group">
			    	{{Form::label('id', 'Category')}}
			    	<?php foreach($data['cat'] as $cat){
			    		$cat_post[$cat->id] = $cat->name;
			    	}  
			    	
					?>
					
					{{Form::select('cat', $cat_post, $data['post_edit']->category , array('class' => 'form-control '))}}			    	
			    </div>
				 
				   <div class="form-group">
				    	{{Form::label('id', 'Status')}}
				    	
						{{Form::select('status', array('draft'=>'Draft','publish'=>'Publish'), $data['post_edit']->flag , array('class' => 'form-control '))}}			    	
				    </div>
				<div class="form-group">
				    	{{Form::submit('Submit!', array('class' => 'btn btn-success submit'))}}	    	
				</div>
			    
              	
               	{{Form::close()}}
				</div>
</div>

@stop