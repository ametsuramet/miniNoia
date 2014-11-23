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

<style>
#share-buttons img {
width: 35px;
padding: 5px;
border: 0;
box-shadow: 0;
display: inline; 

}  
.author_wrapper{
padding: 10px;
background: #eee;
min-height:150px;
font-size:0.8em;
margin-bottom:40px;
}
.author_photo{
width: 120px;
float: left;
overflow: hidden;
height: 120px;
padding-bottom: 10px;
margin: 0 10px 10px 0;
}
.author_photo img{
width:100%
}
</style>
	<header class="intro-header" style="background-image: url({{URL::asset('img/post-bg.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1>{{$post->title}} </h1>
                       @if($post->type=="post")
                        <span class="meta">Posted by <a href="{{URL::to('/category/'.$post->cat_item->slug)}}">{{$post->cat_item->name}}</a> on {{date('d-M-y G:i:s', strtotime($post->publish))}} </span>
                    	@endif
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Post Content -->
    <article>
        <div class="container ">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">    
					 @if(!Auth::guest())
                     <ul class="pager">
						<li class="next">
							<a href="{{URL::to('/admin?id='.$post->id.'&mode=edit')}}">Edit</a>
						</li>
					</ul><br>
                   @endif
	                <?php  if(Session::has('flash_notice')): ?>
		                <div id="flash_notice"><?php echo Session::get('flash_notice') ?></div>
		            <?php endif; ?>     
					<div class="post">
	                {{$post->description}}
					</div>
					<p>Tags :
					 <?php $tags=explode(",",$post->option) ?>
					 @foreach ($tags as $index=>$tag)
						<a href="{{URL::to('/')}}?search={{trim($tag," ")}}">{{$tag}}</a>	,				 
					 @endforeach
					 </p>
					 @if($post->type=="post" || $post->type=="courses")
					 <div class="author_wrapper" itemscope itemtype="http://data-vocabulary.org/Person"> 
					 <span class="author_photo" itemprop="photo"><img src="http://ametw.hol.es/img/IMG_7386.jpg"></span>
					 Hallo, Nama saya adalah <span itemprop="name">Rahmat Supriatna</span> 
					 tapi teman terdekat memanggil saya <span itemprop="nickname">amet</span>. 
					Anda sekarang berada di blog pribadi saya :
					  <a href="http://ametw.hol.es" itemprop="url">http://ametw.hol.es</a>
					  <br>
					  <br>
					  Blog ini saya titik beratkan untuk kursus online pengembangan teknologi website, mudah-mudahan bisa ikut memajukan dunia IT tanah air.
					<br>
					<br>
					Saya tinggal di Bandung, Indonesia dan berprofesi sebagai <span itemprop="title">Praktisi IT</span>
					  di <span itemprop="affiliation"><a href="http://mynoia.com" target="_blank"> Noiatech</a> dan <a href="http://slasher.biz" target="_blank" > Slasher Streetwear</a></span>.
					</div>
					@endif
					  <?php $type="" ?>
					  <?php if($post->type=="courses") $type="?type=courses" ?>
					<!-- Facebook -->
					@if($post->type=="post" || $post->type=="courses")
					<a href="http://www.facebook.com/sharer.php?u=http://ametw.hol.es/article/{{$post->cat_item->slug}}/{{$post->slug}}{{$type}}" target="_blank"><img src="http://www.simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" /></a>
					 
					<!-- Twitter -->
					<a href="http://twitter.com/share?url=http://ametw.hol.es/article/{{$post->cat_item->slug}}/{{$post->slug}}{{$type}}&text={{$post->title}}&hashtags=ametpabrikide" target="_blank"><img src="http://www.simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" /></a>
					 
					<!-- Google+ -->
					<a href="https://plus.google.com/share?url=http://ametw.hol.es/article/{{$post->cat_item->slug}}/{{$post->slug}}{{$type}}" target="_blank"><img src="http://www.simplesharebuttons.com/images/somacro/google.png" alt="Google" /></a>
					
					<a href="http://feeds.feedburner.com/ametCourses" target="_blank"><img src="http://www.simplesharebuttons.com/images/somacro/email.png" alt="Email Rss" /></a> 
					@endif 
					 	<br>
					 	<br>
						<a href="http://slasher.biz" target="_blank" ><img src="{{URL::to('img/')}}/PROMO-BANNER.gif" alt="SLASHER STREETWEAR"/></a>
					   <br>
					   <br>
					 
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
				
				   @if($config['comment'] && $post->type=="post" || $post->type=="courses")
                   <h3>Comment</h3>
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
					{{Form::textarea('commDesc','', array('class' => 'form-control','id'=>'summernote-mini','rows'=>25))}}		    	
			    </div>
			    
				<div class="form-group">
				    	{{Form::submit('Submit!', array('class' => 'submit'))}}	    	
				</div>
			    
              	
               	{{Form::close()}}
                   @endif
                </div>
            </div>
        </div>
    </article>

@stop
