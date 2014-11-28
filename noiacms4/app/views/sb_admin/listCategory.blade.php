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
					Categories
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
					<table class="table table-hover">
               		<thead>
               			<tr>
               				<th>No</th>               				
               				<th>Category</th>
               				<th>Type</th>
               				<th>Edit</th>
               			</tr>
               		</thead>
               		<tbody>
               			
               			@foreach($data['cat'] as $index=>$cat)
               			
               			<tr>
               				<td>{{$index+1}}</td>               				
               				
               				<td>{{$cat->name}}</td>
               				<td>{{$cat->type}}</td>
               				<td>
               					<a href="/addCategory?id={{$cat->id}}&mode=edit"><i class="fa fa-edit"></i> </a>    
               					<a href="/addCategory?id={{$cat->id}}&mode=delete"><i class="fa fa-trash-o"></i> </a>     
               				</td>
               				
               				
               			</tr>
               			@endforeach
               		</tbody>
               	</table>
            
			</div>
</div>
@stop