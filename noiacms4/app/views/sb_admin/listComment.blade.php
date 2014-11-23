@section('content')
<div id="page-wrapper">
	<div class="col-lg-12">
					<?php  if(Session::has('flash_notice')): ?>
						<div id="flash_notice"><?php echo Session::get('flash_notice') ?></div>
					 <?php endif; ?>
               
                </div>
				
            
            <div class="row">
				@if(isset($_GET['mode']))
	           	 	<?php $opt_edit =  json_decode($commEdit->option,true) ?>
	           	 	 <h1 class="page-header">
					Edit Comment
					</h1>
                   {{Form::open(array('url' => '/EditComment', 'method' => 'post'))}}
	           	 		<div class="form-group">
		               		{{Form::hidden('id', $commEdit->id)}}
					    	{{Form::label('id', 'Name')}}
							{{Form::text('commName', $opt_edit['name'] , array('class' => 'form-control'))}}		    	
					    </div>
					    <div class="form-group">               		
					    	{{Form::label('id', 'Email')}}
							{{Form::text('commEmail', $opt_edit['email'] , array('class' => 'form-control'))}}		    	
					    </div>
					    <div class="form-group">               		
					    	{{Form::label('id', 'Website')}}
							{{Form::text('commWeb', $opt_edit['website'] , array('class' => 'form-control'))}}		    	
					    </div>
		              	<div class="form-group">
					    	{{Form::label('id', 'Description')}}
							{{Form::textarea('commDesc',$commEdit->description, array('class' => 'form-control','id'=>'summernote-mini','rows'=>25))}}		    	
					    </div>
					     <div class="form-group">
					    	{{Form::label('id', 'Status')}}
					    	
							{{Form::select('status', array('draft'=>'Draft','publish'=>'Publish'), $commEdit->flag , array('class' => 'form-control '))}}			    	
					    </div>
						<div class="form-group">
						    {{Form::submit('Submit!', array('class' => 'btn submit'))}}	    
						</div>
					    
		              	
		               	{{Form::close()}}
	           	 @else
				  <h1 class="page-header">
					List Comment
					</h1>
               	<table class="table table-hover">
               		<thead>
               			<tr>
               				<th>No</th>
               				<th>Name</th>
               				<th>Email</th>
               				<th>Website</th>
               				<th>Comment</th>               				
               				<th>Status</th>               				
               				<th>Edit</th>
               			</tr>
               		</thead>
               		<tbody>
               			@foreach($data as $index=>$comment)
               			<?php $opt =  json_decode($comment->option,true) ?>
               			<tr>
               				<td>{{$index+1}}</td>   
               				<td>{{$opt['name']}}</td>             				
               				<td>{{$opt['email']}}</td>             				
               				<td>{{$opt['website']}}</td>             				
               				<td>{{$comment->description}}</td>             				
               				<td>{{$comment->flag}}</td>    
               				
               				<td>
               					<a href="{{URL::to('/')}}/comment?id={{$comment->id}}&mode=edit"><i class="fa fa-edit"></i> </a>    
               					<a href="{{URL::to('/')}}/comment?id={{$comment->id}}&mode=delete"><i class="fa fa-trash-o"></i> </a>     
               				</td>
               				
               				
               			</tr>
               			@endforeach
               		</tbody>
               	</table>
               		 @endif
			</div>
</div>
@stop