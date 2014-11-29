@section('content')
	<div class="container">
		<h2 class="module_title">Feature Categories</h2>
		<div class="row">
			<div class="col-md-4">
				<div class="row">
					<div class="panel panel-default etalage">
						  <div class="panel-body">
						  <img src="http://lordofnemesis.com/noiacms31/views/template/nemesis/images/1.jpg" alt="">
						  </div>
						  <div class="panel-footer"><a href="{{URL::to('/')}}/product_cat/sweater">Sweater</a></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="panel panel-default etalage">
						  <div class="panel-body">
						  <img src="http://lordofnemesis.com/noiacms31/views/template/nemesis/images/5.jpg" alt="">
						  </div>
						  <div class="panel-footer"><a href="{{URL::to('/')}}/product_cat/t-shirt">T-shirt</a></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="panel panel-default etalage">
						  <div class="panel-body">
						   <img src="http://lordofnemesis.com/noiacms31/views/template/nemesis/images/3.jpg" alt="">
						  </div>
						  <div class="panel-footer"><a href="{{URL::to('/')}}/product_cat/jacket">Jacket</a></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<h2 class="module_title">Latest Stuffs</h2>
		</div>
		<div class="row">
			@foreach($module['product'] as $product)
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
@stop
