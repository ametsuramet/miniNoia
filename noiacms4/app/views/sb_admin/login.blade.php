@section('content')
	<div class="container">
		<div class="row">
		 <?php  if(Session::has('flash_notice')): ?>
		<div id="flash_notice"><?php echo Session::get('flash_notice') ?></div>
		<?php endif; ?>
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
					<h3 class="panel-title"><i class="fa  fa-child "></i> NoiaCMS 4 - mini version</h3>
					</div>
					<div class="panel-body">
						 {{Form::open(array('url' => '/login', 'method' => 'post'))}}
							<fieldset>
								<div class="form-group">
									 {{Form::text('username','',array('class'=>'form-control','placeholder' => 'Username'))}}
								</div>
								<div class="form-group">
									{{Form::password('password', array('class'=>'form-control','placeholder' => 'Password'));}}
								</div>
								
								<!-- Change this to a button or input when using this as a form -->
								 {{Form::submit('Submit!', array('class' => 'btn btn-lg btn-success btn-block submit'))}}
							</fieldset>
						</form>
						  {{Form::close()}}
					</div>
				</div>
				<small style="text-align:center;display: block;">&copy; 2014 <a href="http://ametw.hol.es">{{$config['author']}}</a></small>
			</div>
		</div>
	</div>
@stop