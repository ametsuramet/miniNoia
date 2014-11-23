@section('meta_title')
Blog Amet Suramet | mudah-mudahan isinya berguna
@stop
@section('content')


    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>{{Config::get('blog.blog_name')}}</h1>
                        <hr class="small">
                        <span class="subheading">{{Config::get('blog.tag_line')}}</span>
                        
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <?php  if(Session::has('flash_notice')): ?>
	                <div id="flash_notice"><?php echo Session::get('flash_notice') ?></div>
	            <?php endif; ?>
                @foreach($data as $i=>$post)
							<?php $type="" ?>						
							<?php if($post->type=="courses") $type = "?type=courses" ?>
	                 <div class="post-preview">
	                    <a href="{{URL::to('/article')}}/{{$post->cat_item->slug}}/{{$post->slug}}{{$type}}">
	                        <h2 class="post-title">
	                            {{$post->title}}
	                        </h2>
	                        <h3 class="post-subtitle">
	                          {{substr(strip_tags(preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>',$post->description)),0,200)}} ...
	                          	
	                       
	                        </h3>
	                    </a>
	                    <p class="post-meta">Posted by <a href="{{URL::to('/category')}}/{{$post->cat_item->slug}}">{{$post->cat_item->name}}</a> on {{$post->publish}}</p>
	                </div>
					  <hr>
				@endforeach
               
                <!-- Pager -->
                
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
				
					<br>
						<a href="http://slasher.biz" target="_blank" ><img src="{{URL::to('img/')}}/PROMO-BANNER.gif" alt="SLASHER STREETWEAR"/></a>
					   <br>
            </div>
        </div>
    </div>

@stop

