@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8">
               
                @foreach($data as $i=>$product)
                <?php $option = json_decode($product->option,true) ?>
	                <div class="row">
	                	<div class="prod_img3">							
							<img  src="{{URL::to('/img/product/')}}/{{$option['img'][1]}}" />
						</div>
						<h2 class="prod_title">{{$product->title}}</h2>
						<a href="{{URL::to('/product_cat/')}}/{{$product->cat_item->slug}}"<small class="prod_cat">{{$product->cat_item->name}}</small></a>
						
						<div class="prod_desc">
							{{substr(strip_tags(preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>',$product->description)),0,200)}} ...
						</div>
						<br>
						 <div class="prod_price">
						IDR	{{number_format($option['price'],0,",",".");}}
						</div>
						<a class="btn btn-xs btn-danger" href="{{URL::to('/product/')}}/{{$product->cat_item->slug}}/{{$product->slug}}">View Detail</a>
					
	                </div>
					  <hr>
				@endforeach
               
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
                        <a href="?page={{$_GET['page']-1}}">&larr; Newer Posts </a>
                    </li>
                    <li class="next">
                        <a href="?page={{$_GET['page']+1}}">Older Posts &rarr;</a>
                    </li>
                </ul>
                @endif
                @else
                  <h2 class="post-title">
	              	Nothing Happens here
	              </h2>
             
                <ul class="pager">
                	<li class="previous">
                        <a href="/"> Go to Home </a>
                    </li>
                    
                </ul>
                @endif
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
@stop


