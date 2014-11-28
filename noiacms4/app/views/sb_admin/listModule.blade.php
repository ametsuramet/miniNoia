@section('content')
<style>
	.col_thumb{
		overflow:hidden;
		width:20%;
	}
	.col_thumb img{
		width:100%
	}
</style>
<div id="page-wrapper">
	<div class="col-lg-12">
					<?php  if(Session::has('flash_notice')): ?>
						<div id="flash_notice"><?php echo Session::get('flash_notice') ?></div>
					 <?php endif; ?>
               
                </div>
				
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
					List {{ucfirst($_GET['type'])}}
					<a href="{{URL::to('/')}}/addModule?type={{$_GET['type']}}"><i class="fa fa-plus"></i> </a>   
               				
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
               				<th>Category</th>
							<th>Thumbnail</th>						
               				<th>Edit</th>
               			</tr>
               		</thead>
               		<tbody>
               			@foreach($data['module'] as $index=>$module)
               			<?php $post_option = json_decode($module->option,true); ?>
               			<tr>
               				<td>{{$index+1}}</td>
               				<td>
               					@if($module->flag=="publish")
               					{{date('d-M-y G:i:s', strtotime($module->publish))}} 
               					@endif
               				</td>
               				<td>{{$module->title}} 
               					@if($post_option['link']!="")
               					<a href="{{URL::to($post_option['link'])}}" target="_blank"><i class="fa fa-external-link-square"></i></a>
               					@endif
               				</td>               				
               				<td>{{$module->cat_item->slug}}</td>
							<td class="col_thumb">
								@if($post_option['img']!="")
								<img src="{{URL::asset('/img/')}}/{{$_GET['type']}}/{{$post_option['img']}}" />
								@endif
							</td>						
               				<td>
               					<a href="{{URL::to('/')}}/addModule?id={{$module->id}}&type={{$module->type}}&mode=edit"><i class="fa fa-edit"></i> </a>    
               					<a href="{{URL::to('/')}}/addModule?id={{$module->id}}&type={{$module->type}}&mode=delete"><i class="fa fa-trash-o"></i> </a>   
               				</td>
               			</tr>
               			@endforeach
               		</tbody>
               	</table>
            
			</div>
</div>
@stop