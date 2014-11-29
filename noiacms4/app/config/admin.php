<?php 

return array( 
"type"=>array("post","page","product"),
"module_type"=>array("gallery","slider","html","testimonial"),
"contact"=>array(
		0=>array("name","Nama Lengkap", "text","fa-user"),
		1=>array("email","Email", "text","fa-envelope-o"),
		2=>array("phone","Telepon", "text","fa-phone-square"),
		3=>array("msg","Masukan Pesan anda", "textarea","fa-pencil-square-o"),
		),
"contact_style"=>array(
		'label' => "style='font-weight:bold;width:200px;display:inline-block;font-family:verdana;margin-bottom:20px'",
		'body' => "style='background:#f5f5f5';font-family:verdana",
		'msg_cont' => "style='font-family:verdana'",
		'heading1' => "style='font-family:verdana;color:#D00;text-align:center;font-size:1.5em;margin-bottom:0'",
		'heading2' => "style='font-family:verdana;color:#333;text-align:center;font-size:1.2em;margin-top:5px'",
		'box' => "style='margin:40px auto 10px;display:block;width:450px;background:#fff;border-radius:4px;padding:20px;box-shadow:0 0 10px #ccc'",
		'footer' => "style='font-family:verdana;display:block;margin:0 auto;width:450px;text-align:center;color:#333'"
		),
"contact_msg"=>array(
		'success' => "Contact Form Berhasil dikirim",
		'fail' => "Contact Form gagal dikirim",
		'empty' => "Form belum diisi dengan lengkap",
		'captcha' => "security code salah",
		),
"contact_to"=>array(
		'send_email'=>"slasherclothing@gmail.com",
		'send_name'=>"Slasher Streetwear",
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
		'Product' => array('/listPage','<i class="fa  fa-files-o">',
			array(
				'Product' => array('/listProduct','<i class="fa  fa-files-o">'),
				'Add Product' => array('/addProduct','<i class="fa  fa-plus-square">'),				
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