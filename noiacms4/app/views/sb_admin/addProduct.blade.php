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
					Product
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
			{{Form::open(array('url' => '/addProduct', 'method' => 'post','files' => true))}}
               	
               	<div class="form-group">
			    	{{Form::hidden('id', $data['post_edit']->id)}}
			    	{{Form::label('id', 'Title')}}
					{{Form::text('title', $data['post_edit']->title , array('class' => 'form-control'))}}			    	
			    </div>
				<div class="form-group">
			    
			    	{{Form::label('slug', 'Slug')}}
					{{Form::text('slug', $data['post_edit']->slug , array('class' => 'form-control'))}}			    	
			    </div>
              	<div class="form-group">
			    	{{Form::label('id', 'Description')}}
					{{Form::textarea('desc', htmlspecialchars($data['post_edit']->description) , array('class' => 'form-control','id'=>'summernote','rows'=>25))}}		    	
			    </div>
			    <div class="form-group">
			    	{{Form::label('id', 'Specification')}}
					{{Form::textarea('spec', htmlspecialchars($data['post_option']['spec']) , array('class' => 'form-control','id'=>'summernote2','rows'=>15))}}		    	
			    </div>
			    <div class="form-group">
			    
			    	{{Form::label('price', 'Price')}}
					{{Form::text('price', $data['post_option']['price'] , array('class' => 'form-control'))}}			    	
			    </div>
			    
			    <div class="row">
			    <div class="col-md-3 thumb_prod">
				    <div class="form-group">			    
				    	{{Form::label('img1', 'Photo 1')}}
				    	@if($data['post_option']['img'][1]!="")
				    	<img  src="{{URL::to('/img/product/')}}/{{$data['post_option']['img'][1]}}">
				    	@endif
						{{Form::file('img1', array('class' => 'form-control'))}}	
						{{Form::hidden('img_hidden1',$data['post_option']['img'][1],array('class' => 'form-control'))}}			    	
				    </div>
				    <i class="fa fa-times  del_thumb" style="cursor:pointer;font-size:1.2em;color:#f00;position:relative;margin:5px auto;text-align:center;display:block"></i>
			    </div>
			    <div class="col-md-3 thumb_prod">
				    <div class="form-group">			    
				    	{{Form::label('img2', 'Photo 2')}}
				    	@if($data['post_option']['img'][2]!="")
				    	<img src="{{URL::to('/img/product/')}}/{{$data['post_option']['img'][2]}}">
				    	@endif
						{{Form::file('img2', array('class' => 'form-control'))}}	
						{{Form::hidden('img_hidden2',$data['post_option']['img'][2],array('class' => 'form-control'))}}			    	
				    </div>
				    <i class="fa fa-times  del_thumb" style="cursor:pointer;font-size:1.2em;color:#f00;position:relative;margin:5px auto;text-align:center;display:block"></i>
			    </div>
			    <div class="col-md-3 thumb_prod">
				    <div class="form-group">			    
				    	{{Form::label('img3', 'Photo 3')}}
				    	@if($data['post_option']['img'][3]!="")
				    	<img  src="{{URL::to('/img/product/')}}/{{$data['post_option']['img'][3]}}">
				    	@endif
						{{Form::file('img3', array('class' => 'form-control'))}}	
						{{Form::hidden('img_hidden3',$data['post_option']['img'][3],array('class' => 'form-control'))}}			    	
				    </div>
				    <i class="fa fa-times  del_thumb" style="cursor:pointer;font-size:1.2em;color:#f00;position:relative;margin:5px auto;text-align:center;display:block"></i>
			    </div>		
				<div class="col-md-3 thumb_prod">
				    <div class="form-group ">			    
				    	{{Form::label('img4', 'Photo 4')}}
				    	@if($data['post_option']['img'][4]!="")
				    	<img  src="{{URL::to('/img/product/')}}/{{$data['post_option']['img'][4]}}">
				    	@endif
						{{Form::file('img4', array('class' => 'form-control'))}}	
						{{Form::hidden('img_hidden4',$data['post_option']['img'][4],array('class' => 'form-control'))}}			    	
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