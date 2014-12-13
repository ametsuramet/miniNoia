@section('menu')
<li class=""><a href="{{URL::to('/')}}" data-toggle="tooltip" data-placement="right" data-original-title="Home"><i class="fa fa-home"></i></a></li>
<li class=""><a href="{{URL::to('/product_cat/all')}}" data-toggle="tooltip" data-placement="right" data-original-title="Products"><i class="fa fa-shield"></i></a></li>
<li class=""><a href="{{URL::to('/gallery/all')}}" data-toggle="tooltip" data-placement="right" data-original-title="Gallery"><i class="fa fa-image"></i></a></li>                
<li class=""><a href="{{URL::to('/category/all')}}" data-toggle="tooltip" data-placement="right" data-original-title="Last Articles"><i class="fa fa-file-text"></i></a></li>
@stop
@section('content')

<div class="container-fluid">
		
			
	<h1 class="section-title" >Gallery 
	<!-- Single button -->
		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		    <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" role="menu">		  
		  	@foreach($all_cat as $cat)
		    <li><a href="{{URL::to('/gallery/')}}/{{$cat->slug}}">{{$cat->name}}</a></li>
		   	@endforeach
		  </ul>
		</div>	
	 </h1>
			<section id="gallery_content">
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
			@foreach($data as $index=>$gallery)
			<?php $option = json_decode($gallery->option,true) ?>
			<div class="f1_container">
				<div class="f1_card" class="shadow">
				  <div class="front face">
					<img src="{{URL::to('/img/gallery/')}}/{{$option['img']}}" alt="{{htmlentities($gallery->title)}}" /> 
				  </div>
				  <div class="back face center">
						 
					<a href="{{URL::to('/img/gallery/')}}/{{$option['img']}}" rel="prettyPhoto[pp_gal]" alt="{{htmlentities($gallery->title)}}" title="{{htmlentities($gallery->description)}}">
						<h3>{{$gallery->title}}</h3>
					</a>
				  </div>
				</div>
			</div>		
			@endforeach
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
