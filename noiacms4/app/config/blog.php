<?php 

return array( 
"list_item"=>"7", 
"author"=>"amet suramet",
"blog_name"=>"Blog Amet Suramet | mudah-mudahan isinya berguna",
"description"=>"Selamat datang di Blog Amet suramet, blog ini saya dedikasikan untuk pengembangan dunia IT Indonesia, beberapa isi didalamnya daya tekankan pada tutorial pengembangan Frontend dan Backend website, seperti HTML javascript, css, php, mysql, codeigniter, laravel dan beberapa artikel pribadi saya",
"tag_line"=>"dari iseng jadi ilmu",
"keyword"=>"tutotial, html, javascript, css, php, mysql, blog, codeigniter, laravel,slasher, amet, suramet, frontend, backend, kursus online",
"alias"=>"ametw.hol.es",
"avatar"=>"http://ametw.hol.es/img/avatar.jpg",
"comment"=>true,
"menu"=>array(
		'About'=>'page/about-amet',
		'IT'=>'category/it',
		'Kursus'=>'listCourses',
		'Slasher'=>'category/slasher',
		'Blog'=>'category/blog',
		'Bisnis'=>'category/bisnis',
		),
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
"twitter"=>"ametpabrikide",
"facebook"=>"ametsuramet",
"google+"=>"ametsuramet"
);