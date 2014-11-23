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
					Add Page
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
				{{Form::open(array('url' => '/addPage', 'method' => 'post'))}}
               	
               	<div class="form-group">
               		{{Form::hidden('id', $data['post_edit']->id)}}
			    	{{Form::label('id', 'Title')}}
					{{Form::text('title', $data['post_edit']->title , array('class' => 'form-control'))}}		    	
			    </div>
              	<div class="form-group">
			    	{{Form::label('id', 'Description')}}
					{{Form::textarea('desc', $data['post_edit']->description , array('class' => 'form-control','id'=>'summernote','rows'=>25))}}		    	
			    </div>
			     <div class="form-group">
				    	{{Form::label('id', 'Status')}}
				    	
						{{Form::select('status', array('draft'=>'Draft','publish'=>'Publish'), $data['post_edit']->flag , array('class' => 'form-control '))}}			    	
				    </div>
				<div class="form-group">
				    	{{Form::submit('Submit!', array('class' => 'btn submit'))}}	    
				</div>
			     
              	
               	{{Form::close()}}
            
			</div>
</div>
@stop