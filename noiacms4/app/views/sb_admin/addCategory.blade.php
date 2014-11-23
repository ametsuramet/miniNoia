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
				{{Form::open(array('url' => '/addCategory', 'method' => 'post'))}}
               	
               	<div class="form-group">
               		{{Form::hidden('id', $data['cat_edit']->id)}}
			    	{{Form::label('id', 'Title')}}
					{{Form::text('name', $data['cat_edit']->name , array('class' => 'form-control'))}}		    	
			    </div>
              	 <div class="form-group">
				    	{{Form::label('id', 'Type')}}
				    	
						{{Form::select('type', array('post'=>'Post','courses'=>'Kursus','gallery'=>'Gallery'), $data['cat_edit']->type , array('class' => 'form-control '))}}			    	
				    </div>
				<div class="form-group">
				    	{{Form::submit('Submit!', array('class' => 'btn submit'))}}	    
				</div>
			    
              	
               	{{Form::close()}}
            
			</div>
</div>
@stop