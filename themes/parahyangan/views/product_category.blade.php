@section('menu')
<li class=""><a href="{{URL::to('/')}}" data-toggle="tooltip" data-placement="right" data-original-title="Home"><i class="fa fa-home"></i></a></li>
<li class=""><a href="{{URL::to('/product_cat/all')}}" data-toggle="tooltip" data-placement="right" data-original-title="Products"><i class="fa fa-shield"></i></a></li>
<li class=""><a href="{{URL::to('/gallery/all')}}" data-toggle="tooltip" data-placement="right" data-original-title="Gallery"><i class="fa fa-image"></i></a></li>                
<li class=""><a href="{{URL::to('/category/all')}}" data-toggle="tooltip" data-placement="right" data-original-title="Last Articles"><i class="fa fa-file-text"></i></a></li>
@stop
@section('content')

<div class="container-fluid">
		
			
	<h1 class="section-title" >Product
<!-- Single button -->
		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		    <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" role="menu">		  
		  	@foreach($all_cat as $cat)
		    <li><a href="{{URL::to('/product_cat/')}}/{{$cat->slug}}">{{$cat->name}}</a></li>
		   	@endforeach
		  </ul>
		</div>	
	</h1>
			<section id="category_content">
			<div class="col-md-8">
			@if(!count($data))
			 <h2 class="post-title">
	              	Not available page
	              </h2>
             
                <ul class="pager">
                	<li class="previous">
                        <a href="{{URL::previous()}}"> Go BACK </a>
                    </li>
                    
                </ul>
			@endif
			 @foreach($data as $i=>$product)
			 <?php $option = json_decode($product->option,true) ?>
	                 <div class="product-list">
	                 	<div class="prod_img">							
								<img  src="{{URL::to('/img/product/')}}/{{$option['img'][1]}}" />
							</div>	
	                    <a href="{{URL::to('/product')}}/{{$product->cat_item->slug}}/{{$product->slug}}">
	                        <h2 class="post-title">
	                            {{$product->title}}
	                        </h2>
	                     </a>
	                        <p class="post-subtitle">
	                         {{substr(strip_tags(preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>',$product->description)),0,200)}} ...
	                        </p>
	                   
	                    <p class="post-meta2">Category <a href="{{URL::to('/product_cat')}}/{{$product->cat_item->slug}}">{{$product->cat_item->name}}</a> on {{$product->publish}}</p>
	                </div>
					  <hr>
			@endforeach
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
			<div class="row">
			<div class="col-md-12">
		      @if(count($data))		      
                @if(!isset($_GET['page']))
              
                <ul class="pager">
                    <li class="next">
                        <a href="?page=2">Older Posts &rarr;</a>
                    </li>
                </ul>
                @else            
               
                <ul class="pager">
                	<li class="previous">
                		@if($_GET['page']!=1)
                        <a href="?page={{$_GET['page']-1}}">&larr; Newer Posts </a>
                        @endif
                    </li>
                    <li class="next">
                        <a href="?page={{$_GET['page']+1}}">Older Posts &rarr;</a>
                    </li>
                </ul>
                @endif
                @else
                 
                @endif	
                </div>
                </div>
	</div>

@stop