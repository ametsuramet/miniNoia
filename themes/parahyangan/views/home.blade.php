@section('content')
{{ HTML::ul($errors->all(), array('class'=>'errors')) }}
<?php  if(Session::has('flash_notice')): ?>
	<div id="flash_notice"><?php echo Session::get('flash_notice') ?></div>
<?php endif; ?>
<section id="carouselHacked" class="carousel slide carousel-fade" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
        	@foreach($add_module['slider'] as $index=>$mod)
        	<?php $option = json_decode($mod->option,true) ?>
            <div class="item 
            @if($index==0)
            active
            @endif
            ">
				<img src="img/slider/{{$option['img']}}" alt="...">
                <div class="carousel-caption">
                	{{$mod->description}}
               	</div>
            </div>
            @endforeach
           
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carouselHacked" role="button" data-slide="prev">
            <i class="fa fa-arrow-circle-left"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carouselHacked" role="button" data-slide="next">
           <i class="fa fa-arrow-circle-right"></i>
            <span class="sr-only">Next</span>
        </a>
    </section>
    
	<section id="product">
	<div class="container-fluid">
	
	<h1 class="section-title" >Products </h1>
	 <a class="control-product left" href="#carousel-example-generic" role="button" data-slide="prev">
		  <i class="fa fa-arrow-left"></i>
		<span class="sr-only">Previous</span>
	  </a>
	  <a class="control-product right" href="#carousel-example-generic" role="button" data-slide="next">
		  <i class="fa fa-arrow-right"></i>
		<span class="sr-only">Next</span>
	  </a>
	<div class="col-md-12">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			 <div class="carousel-inner" role="listbox">
			 		@for($i=0;$i<3;$i++)
			 		<?php $j = $i*3 ; $k = $j+2	 ?>	
					@foreach($product as $index=>$prod)
						@if($index == $j)
						<div class="item 
						@if($j==0)
							active
						@endif
						">						
						@endif
						<?php $option = json_decode($prod->option,true) ?>	
						@if($index >= $j && $index <= $k)      
			            		<div class="col-md-4">
									<div class="panel panel-default">
										<div class="img_wrapper">
											<img src="img/product/{{$option['img']['1']}}" alt="...">
										</div>
									  <div class="panel-body">
											<h3 class="panel-title">{{$prod->title}}</h3>
									  </div>
									  <div class="panel-footer">
										<a href="#" class="btn btn-success" role="button">View Listing</a>
									  </div>
									</div>
								  </div>
						@endif	
				       @if($index == $k)
				      </div>
				       @endif     
		            @endforeach			 			
			 		@endfor
				</div>
			</div>
		</div>
	</div>
	</section>
	<section id="gallery">
	<div class="container-fluid">
	
	<h1 class="section-title" >Gallery</h1>
			@foreach($add_module['gallery'] as $gallery)
			<?php $option = json_decode($gallery->option,true) ?>
			<div class="f1_container">
				<div class="f1_card" class="shadow">
				  <div class="front face">
					<img src="img/gallery/{{$option['img']}}"/> 
				  </div>
				  <div class="back face center">
					{{$gallery->description}}
				  </div>
				</div>
			</div>
			@endforeach
			
	</div>
	</section>
	
	<section id="testimonials">
		<div class="container-fluid">
		
	<h1 class="section-title" >Testimonials</h1>
		<div class="col-md-12">
			<div id="carousel-testimonials" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				  	@foreach($add_module['testimonial'] as $index=>$testi)				  	 
				  	 @if($index==0)
			         	<?php $active = "active"; ?>
			         @else
			         	<?php $active = ""; ?>
			         @endif
					<li data-target="#carousel-testimonials" data-slide-to={{$index}} class="{{$active}}"></li>
					@endforeach
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
				  	 @foreach($add_module['testimonial'] as $index=>$testi)				  	 
				  	 @if($index==0)
			         	<?php $active = "active"; ?>
			         @else
			         	<?php $active = ""; ?>
			         @endif
	             	  	<div class="item {{$active}}">					  
						 	 <div class="carousel-caption">
								 {{$testi->description}}
							 </div>
						</div>               
	                @endforeach 				
				  </div>
				</div>
		</div>
		</div>
	</section>
	<section id="contact">
	<div class="container">
	    <div class="row">
	        <div class="col-md-12">
	            <div class="well well-sm">
	            	
	            	
		            <iframe src="{{URL::to('/')}}/show_module/html/maps-slasher" style="width:620px;border:none;overflow:hidden;height:350px;display:block;margin:0 auto"></iframe>
	              <form class="form-horizontal" method="post" action="{{URL::to('/sendContact')}}">
					  <fieldset>
					    <legend class="text-center header">
					      Contact us
					    </legend>
					    @foreach($contact as $index=>$con)
					    <div class="form-group">
					      <span class="col-md-1 col-md-offset-2 text-center">
					        <i class="fa {{$con[3]}} bigicon">
					        </i>
					      </span>
					      <div class="col-md-8">
					      	@if($con[2]=="text")
					        <input id="{{$con[0]}}" name="{{$con[0]}}" type="text" placeholder="{{$con[1]}}" class="form-control">
					        @else
					         <textarea id="{{$con[0]}}" name="{{$con[0]}}" type="text" placeholder="{{$con[1]}}"  class="form-control" rows=7 ></textarea>
					        @endif
					        </div>
					      </div>
					     @endforeach
					     <div class="form-group">
					      <span class="col-md-1 col-md-offset-2 text-center">
					        
					      </span>
					      <div class="col-md-8">
					      	 <input id="captcha" name="captcha" type="text" placeholder="enter security code" class="form-control">
					      	 <img src="{{Captcha::url()}}">
					      	 
					        </div>
					      </div>
					           
					            <div class="form-group">
					              <div class="col-md-12 text-center">
					                <button type="submit" class="btn btn-primary btn-lg">
					                  Submit
					                </button>
					              </div>
					            </div>
					          </fieldset>
					        </form>
			    </div>
			</div>
		</div>
	</div>

	</section>
@stop
