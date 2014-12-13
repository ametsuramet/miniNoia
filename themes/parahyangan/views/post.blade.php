@section('menu')
<li class=""><a href="{{URL::to('/')}}" data-toggle="tooltip" data-placement="right" data-original-title="Home"><i class="fa fa-home"></i></a></li>
@stop
@section('content')
<?php $product_option = json_decode($post->option,true) ?>
<div class="container-fluid">
		
	{{ HTML::ul($errors->all(), array('class'=>'errors')) }}
	<?php  if(Session::has('flash_notice')): ?>
	    <div id="flash_notice"><?php echo Session::get('flash_notice') ?></div>
	<?php endif; ?>  
	<h1 class="section-title" >{{$post->title}}</h1>
	<p class="post-meta">Posted by <a href="{{URL::to('/category')}}/{{$post->cat_item->slug}}">{{$post->cat_item->name}}</a> on {{$post->publish}}</p>
	         <hr>       
			<section id="category_content">
			<div class="col-md-8">
				
					
				{{$post->description}}
				
				@if($config['comment'])
				<div class="row">
					<h3 class="sub_title">Comments</h3>
					<hr>
					<div class="col-md-6">
						  {{Form::open(array('url' => '/addComment', 'method' => 'post'))}}
	               	
	               	<div class="form-group">
	               		{{Form::hidden('id', $post->id)}}
	               		{{Form::hidden('type', $post->type)}}
				    	{{Form::label('id', 'Name')}}
						{{Form::text('commName', '' , array('class' => 'form-control'))}}		    	
				    </div>
				    <div class="form-group">               		
				    	{{Form::label('id', 'Email')}}
						{{Form::text('commEmail', '' , array('class' => 'form-control'))}}		    	
				    </div>
				    <div class="form-group">               		
				    	{{Form::label('id', 'Website')}}
						{{Form::text('commWeb', '' , array('class' => 'form-control'))}}		    	
				    </div>
	              	<div class="form-group">
				    	{{Form::label('id', 'Description')}}
						{{Form::textarea('commDesc','', array('class' => 'form-control','id'=>'summernote-mini','rows'=>9))}}		    	
				    </div>
				     <div class="form-group">
			      	 <input id="captcha" name="captcha" type="text" placeholder="enter security code" class="form-control">
			      	 <img src="{{Captcha::url()}}">
			      	 
			        </div>
					
					<div class="form-group">
					    	{{Form::submit('Submit!', array('class' => 'submit btn-danger'))}}	    	
					</div>
				    
	              	
	               	{{Form::close()}}
					
					</div>
					<div class="col-md-6">
					@if(count($comment) )
	                    <section class="comment">	                    	
	                    	@foreach($comment as $comm)
	                    	<div>
	                    	<?php $opt =  json_decode($comm->option,true) ?>
	                    		<h4>
		                            
		                            @if($opt['website']!="") 
		                            <?php $website = str_replace('http://','',str_replace('https://', '', $opt['website'])) ?>
		                            <a href="http://{{$website}}" target="_blank">{{$opt['name']}}</a>
		                            @else
		                            {{$opt['name']}}
		                            @endif
		                        </h4>
		                        {{$comm->description}}
		                    </div>
	                    	@endforeach
	                    </section>
	                @else
	                	<section class="comment">	                    	
	                    	
	                    	<div>
	                    		comments in this post is not available yet, be the first commentator
		                    </div>
	                    
	                    </section>
	                @endif
	                 
					</div>
					
				</div>
				@endif
			</div>
			<div class="col-md-4">
				
				
				<div class="panel module-right">
					<div class="panel-body">
					<h3 class="col-md-12 module-title" >Popular Product</h3>
					@foreach($module['popular_product'] as $product)
						<?php $option = json_decode($product->option,true) ?>
						
						<div class="col-md-12 module_list">
							<div class="prod_img2">							
								<img  src="{{URL::to('/img/product/')}}/{{$option['img'][1]}}" />
							</div>						
							<h4 class="prod_title2">{{$product->title}}</h4>
							<a href="{{URL::to('/product_cat/')}}/{{$product->cat_item->slug}}"<small class="prod_cat">{{$product->cat_item->name}}</small></a>
							@if($option['price']!="")
							<div class="prod_price">
							IDR	{{number_format($option['price'],0,",",".");}}
							</div>
							@endif
							<br>
							<a class="btn btn-xs btn-danger" href="{{URL::to('/product/')}}/{{$product->cat_item->slug}}/{{$product->slug}}">View Detail</a>
						</div>
						<hr>			
					@endforeach
					</div>
				</div>
				
			</div>
			</section>	
			
	</div>

@stop
