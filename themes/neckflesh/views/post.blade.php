<?php $type=""?>
@if($post->type=="courses")
<?php $type="?type=courses"?>
@endif
@section('meta_url') 
@if($post->type=="page")
{{URL::to('/')}}/page/{{$post->slug}}
@else
{{URL::to('/')}}/{{$post->cat_item->slug}}/{{$post->slug}}{{$type}}
@endif
@stop
@section('meta_title')
{{$post->title}}
@stop
@section('meta_section') 
@if($post->type=="post" || $post->type=="courses")
{{$post->cat_item->name}}
@endif
@stop
@section('meta_tag')
{{$post->option}}
@stop
@section('meta_publish')
{{$post->publish}}
@stop
@section('meta_update')
{{$post->updated_at}}  
@stop

@section('content')
	<div class="container">
		
		
		<div class="row">
			<div class="col-md-8">
				<h3 class="post_title">{{$post->title}}</h3>
				
				{{$post->description}}
				<?php  if(Session::has('flash_notice')): ?>
	                <div id="flash_notice"><?php echo Session::get('flash_notice') ?></div>
	            <?php endif; ?>   
				
                
				@if($config['comment'])
				<h3 class="sub_title">Comments</h3>
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
                @endif
                
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
				    	{{Form::submit('Submit!', array('class' => 'submit btn-danger'))}}	    	
				</div>
			    
              	
               	{{Form::close()}}
				@endif
				<hr>
				<div class="row">
					<h2 class="module_title">Random Stuffs</h2>
				</div>
				<div class="row">
					
					@foreach($module['random_product'] as $product)
					<?php $option = json_decode($product->option,true) ?>
					
					<div class="col-md-3">
						<div class="prod_img">
							
							<img  src="{{URL::to('/img/product/')}}/{{$option['img'][1]}}" />
						</div>
						
						<h4 class="prod_title">{{$product->title}}</h4>
						<a href="{{URL::to('/product_cat/')}}/{{$product->cat_item->slug}}"<small class="prod_cat">{{$product->cat_item->name}}</small></a>
						<div class="prod_price">
						IDR	{{number_format($option['price'],0,",",".");}}
						</div>
						<a class="btn btn-xs btn-danger" href="{{URL::to('/product/')}}/{{$product->cat_item->slug}}/{{$product->slug}}">View Detail</a>
					</div>
					@endforeach
				</div>
			</div>
			<div class="col-md-4">
					<div class="row">
						<h3 class="module_title2">Popular Stuffs</h2>
					</div>
					
					
					@foreach($module['popular_product'] as $product)
					<?php $option = json_decode($product->option,true) ?>
					
					<div class="row module_list">
						<div class="prod_img2">							
							<img  src="{{URL::to('/img/product/')}}/{{$option['img'][1]}}" />
						</div>						
						<h4 class="prod_title2">{{$product->title}}</h4>
						<a href="{{URL::to('/product_cat/')}}/{{$product->cat_item->slug}}"<small class="prod_cat">{{$product->cat_item->name}}</small></a>
						<div class="prod_price">
						IDR	{{number_format($option['price'],0,",",".");}}
						</div>
						<a class="btn btn-xs btn-danger" href="{{URL::to('/product/')}}/{{$product->cat_item->slug}}/{{$product->slug}}">View Detail</a>
					</div>
					@endforeach
			</div>
		</div>
		</div>
	</div>
@stop