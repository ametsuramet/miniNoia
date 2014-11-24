<?php 

return array( 
"menu_admin"=>array(
		'Post' => array('/listPost','<i class="fa  fa-file">',
			array(
				'List Post' => array('/listPost','<i class="fa  fa-file">'),
				'Courses' => array('/listPost?type=courses','<i class="fa  fa-file">'),
				'Add Post' => array('/admin','<i class="fa  fa-plus-square">'),
				'Comment' => array('/comment','<i class="fa  fa-comments">'),
				)
			),
		'Page' => array('/listPage','<i class="fa  fa-files-o">',
			array(
				'Page' => array('/listPage','<i class="fa  fa-files-o">'),
				'Add Page' => array('/addPage','<i class="fa  fa-plus-square">'),				
				)
			),
		'Category' => array('/listCategory','<i class="fa  fa-files-o">',
			array(
				'Category' => array('/listCategory','<i class="fa  fa-files-o">'),
				'Add Category' => array('/addCategory','<i class="fa  fa-plus-circle">'),	
				)
			),
		'User' => array('/listUser','<i class="fa fa-user">',
			array(
				'User' => array('/listUser','<i class="fa  fa-user">'),
				'Add User' => array('/addUser','<i class="fa  fa-plus-circle">'),
				)
			),		
		),
	);