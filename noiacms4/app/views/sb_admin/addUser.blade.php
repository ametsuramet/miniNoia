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
			{{Form::open(array('url' => '/addUser', 'method' => 'post'))}}

               	<div class="form-group">
               		{{Form::hidden('id', $data['user_edit']->id)}}
			    	{{Form::label('id', 'Name')}}
					{{Form::text('name', $data['user_edit']->name , array('class' => 'form-control'))}}		    	
			    </div>
              	<div class="form-group">
			    	{{Form::label('id', 'Username')}}
					{{Form::text('username', $data['user_edit']->username , array('class' => 'form-control'))}}		 	    	
			    </div>
				<div class="form-group">
			    	{{Form::label('id', 'Email')}}
					{{Form::text('email', $data['user_edit']->email , array('class' => 'form-control'))}}		 	    	
			    </div>
			   <div class="form-group">
			    	{{Form::label('id', 'Password')}}
					{{Form::password('password', array('class' => 'form-control'))}}		 	    	
			    </div>
				<div class="form-group">
			    	{{Form::label('id', 'Repeat Password')}}
					{{Form::password('password2', array('class' => 'form-control'))}}		 	    	
			    </div>
				<div class="form-group">
				    	{{Form::submit('Submit!', array('class' => 'btn submit'))}}	     	
				</div>
			    
              	
               	{{Form::close()}}
			</div>
</div>
@stop