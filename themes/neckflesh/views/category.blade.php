@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8">
               
                @foreach($data as $i=>$post)
	                 <div class="post-preview">
	                    <a href="{{URL::to('/article')}}/{{$post->cat_item->slug}}/{{$post->slug}}">
	                        <h2 class="post-title">
	                            {{$post->title}}
	                        </h2>
	                     </a>
	                        <p class="post-subtitle">
	                         {{substr(strip_tags(preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>',$post->description)),0,200)}} ...
	                        </p>
	                   
	                    <p class="post-meta">Category <a href="{{URL::to('/category')}}/{{$post->cat_item->slug}}">{{$post->cat_item->name}}</a> on {{$post->publish}}</p>
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
        </div>
    </div>
@stop


