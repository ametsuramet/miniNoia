@section('meta_title')
Blog Amet Suramet | mudah-mudahan isinya berguna
@stop
@section('content')

<style>
.subheading2{
font-size:0.8em
}
</style>
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('{{URL::to('/img/home-bg.jpg')}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Selamat Datang Di Kursus Online Amet Suramet</h1>
                        <hr class="small">
                        <span class="subheading">Halaman ini saya dedikasikan untuk kemajuan dunia IT Indonesia, semua materi berdasarkan pengalaman pribadi selama menjadi praktisi IT, tanpa bermaksud menggurui, saya hanya ingin berbagi ilmu dengan semuanya :)</span>
                        
						
						<form style="padding:3px;text-align:center;" action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=ametCourses', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
				  <input type="hidden" value="ametCourses" name="uri"/>
				  <input type="hidden" name="loc" value="en_US"/> 			  
				  <input type="text" placeholder="ex: email@email.com" name="email" class="form-control">	
						
						<span class="subheading2">untuk mendapatkan postingan terbaru dari Kursus ini silahkan masukan email anda</span>
						<br>
					<input type="submit" class="btn btn-default" type="button" value="  Kirim  " />
				</form>
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
				<div class="btn-group">
				  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
				    Pilih Kategori <span class="caret"></span>
				  </button>
				<ul class="dropdown-menu" role="menu">
				    @foreach($cat_all as $cats)
					 <li><a href="{{URL::to('/catCourses/')}}/{{$cats->slug}}"> {{$cats->name}} </a></li>
					@endforeach				    
				  </ul>
				  </div>
				
				  
                <h1>Artikel Terbaru</h1>
	                 <table class="table table-hover">
               		<thead>
               			<tr>
               				<th>No</th>
               				<th>Publish</th>
               				<th>Title</th>
               				
               				<th>Category</th>
               			
							<th>Hit</th>
               				
               			</tr>
               		</thead>
               		<tbody>
               			@foreach($data as $index=>$post)
               			
               			<tr>
               				<td>{{$index+1}}</td>               				
               				<td>
               		
               					{{date('d-M-y G:i:s', strtotime($post->publish))}} 
               			
               				</td>
							
               				<td><a href="{{URL::to('/article')}}/{{$post->cat_item->slug}}/{{$post->slug}}?type=courses">{{$post->title}}</a></td>
               				
							
				
               				<td><a href="{{URL::to('/catCourses')}}/{{$post->cat_item->slug}}">{{$post->cat_item->name}}</a></td>
							<td>{{$post->hit}}</td>
               				
               				
               				
               			</tr>
               			@endforeach
               		</tbody>
               	</table>
			
               
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

