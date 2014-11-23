@section('content')
<div id="page-wrapper">
	<div class="col-lg-12">
					<?php  if(Session::has('flash_notice')): ?>
						<div id="flash_notice"><?php echo Session::get('flash_notice') ?></div>
					 <?php endif; ?>
               
                </div>
				
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
					List Post/Page
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
				<table class="table table-hover">
               		<thead>
               			<tr>
               				<th>No</th>
               				<th>Publish</th>
               				<th>Title</th>
               				@if($data['type']=="post")
               				<th>Category</th>
							<th>Hit</th>
               				@endif
							
               				<th>Edit</th>
               			</tr>
               		</thead>
               		<tbody>
               			@foreach($data['post'] as $index=>$post)
               			
               			<tr>
               				<td>{{$index+1}}</td>               				
               				<td>
               					@if($post->flag=="publish")
               					{{date('d-M-y G:i:s', strtotime($post->publish))}} 
               					@endif
               				</td>
							<?php $type="" ?>						
							<?php if(isset($_GET['type'])) $type = "?type=".$_GET['type'] ?>
               				
               				@if($data['type']=="post")
							<td><a href="{{URL::to('/article')}}/{{$post->cat_item->slug}}/{{$post->slug}}{{$type}}">{{$post->title}}</a></td>
				
               				<td><a href="{{URL::to('/category')}}/{{$post->cat_item->slug}}">{{$post->cat_item->name}}</a></td>
							<td>{{$post->hit}}</td>
							@elseif($data['type']=="page")
							<td><a href="{{URL::to('/page')}}/{{$post->slug}}{{$type}}">{{$post->title}}</a></td>
							@else
               				@endif
               				@if($data['type']=="post")
               				<td>
               					<a href="{{URL::to('/')}}/admin?id={{$post->id}}&mode=edit"><i class="fa fa-edit"></i> </a>    
               					<a href="{{URL::to('/')}}/admin?id={{$post->id}}&mode=delete"><i class="fa fa-trash-o"></i> </a>     
               				</td>
               				@else
               				<td>
               					<a href="{{URL::to('/')}}/addPage?id={{$post->id}}&mode=edit"><i class="fa fa-edit"></i> </a>    
               					<a href="{{URL::to('/')}}/addPage?id={{$post->id}}&mode=delete"><i class="fa fa-trash-o"></i> </a>     
               				</td>
               				@endif
               				
               			</tr>
               			@endforeach
               		</tbody>
               	</table>
            
			</div>
</div>
@stop