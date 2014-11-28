<?php

class AdminController extends \BaseController {

	
	public function admin()
	{
		$data = array();
		$edit = false;
		$post_edit =(object)array(
					'id'=>null,
					'title'=>null,
					'slug'=>null,
					'description'=>null,
					'category'=>null,
					'option'=>null,
					'flag'=>'publish',
					);
		
		$cat = Cat_item::all();
		$post = Post::with('cat_item')->where('type','post')->get();
		if(isset($_GET['mode'])){
			if($_GET['mode']=="delete"){
				$post_delete = Post::find($_GET['id']);
				$title = $post_delete->title;
		        $post_delete->delete();
				return Redirect::to('/listPost')->with('flash_notice', $title . " Berhasil dihapus");
			}else{
				$edit = true;
				
				$post_edit = Post::with('cat_item')->find($_GET['id']);
			}
			
		}		
		$data = array(
				'post'=>$post,
				'cat'=>$cat,				
			
				'edit'=>$edit,				
				'post_edit'=>$post_edit,				
				);	 
		$config = Config::get('admin');
        	
		
		$this->layout = View::make('sb_admin.master')->with('config',$config);
		$this->layout->content = View::make('sb_admin.dashboard')->with('data',$data)->with('config',$config);
	}
	
	public function listPost(){
		$data = array();
		if(!isset($_GET['type'])){
		$post = Post::with('cat_item')->where('type','post')->orderBy('id','desc')->get();
		}else{
		$post = Post::with('cat_item')->where('type',$_GET['type'])->orderBy('id','desc')->get();
		}
		$data = array(
				'post'=>$post,				
				'type'=>'post',				
				'title'=>'List Post ',				
				);	
		$config = Config::get('admin');
		
		$this->layout = View::make('sb_admin.master')->with('config',$config);		
		$this->layout->content = View::make('sb_admin.listPost')->with('data',$data)->with('config',$config);
	}
	public function listPage(){
		$data = array();
		
		$post = Post::where('type','page')->orderBy('id','desc')->get();
		$data = array(
				'post'=>$post,				
				'type'=>'page',				
				'title'=>'List Page ',				
				);	
		$config = Config::get('admin');
        
		$this->layout = View::make('sb_admin.master')->with('config',$config);
		$this->layout->content = View::make('sb_admin.listPost')->with('data',$data)->with('config',$config);
	}
	
	
	public function  tambahUser()
	{
		$edit = false;
		$user_edit =(object)array(
					'id'=>null,
					'name'=>null,
					'username'=>null,
					'email'=>null,					
					);
		
		$user = Pengguna::all();
		if(isset($_GET['mode'])){
			if($_GET['mode']=="delete"){
				$user_delete = Pengguna::find($_GET['id']);
				$title = $user_delete->name;
		        $user_delete->delete();
				return Redirect::to('/listPage')->with('flash_notice', $title . " Berhasil dihapus");
			}else{
				$edit = true;
				$user_edit = Pengguna::find($_GET['id']);
			}
			
		}
			
		$data = array(
				'user'=>	$user,	
				'edit'=>$edit,				
				'user_edit'=>$user_edit,				
				);	
				
		$config = Config::get('admin');
         
		$this->layout = View::make('sb_admin.master')->with('config',$config); 		
		$this->layout->content = View::make('sb_admin.addUser')->with('data',$data)->with('config',$config);
		
		//print_r($data);
	}
	
	public function listUser()
	{
		$data = array();
		
		$user = Pengguna::all();
	
		$config = Config::get('admin');
       
		$this->layout = View::make('sb_admin.master')->with('config',$config);
		$this->layout->content = View::make('sb_admin.listUser')->with('data',$user)->with('config',$config);
	}
	public function  tambahUserProses()
	{
		if(Input::get('id')==""){
			$data = new Pengguna;
		}else{
			$data = Pengguna::find(Input::get('id'));
		}
		
		if(Input::get('password')==Input::get('password2')){
			
			$data->name = Input::get('name');
			$data->username = Input::get('username');
			$data->email = Input::get('email');
			$data->password =Hash::make(Input::get('password'));
			
			$data->save();
			return Redirect::to('/listUser')->with('flash_notice', Input::get('name') . " Berhasil ditambahkan");
		}else{
			 Redirect::back()->withInput()->with('flash_notice', 'Password tidak sama');
		}
	}
	
	

	public  function addPost()
	{
		if(Input::get('id')==""){
			$data = new Post;
		}else{
			$data = Post::find(Input::get('id'));
		}
		$type = "post";
		$redirect = "";
		$slug = Slugify::slugify(Input::get('title'));
		$cat = Cat_item::find(Input::get('cat'));
		
		if($cat->type=="courses"){
			$type = "courses";
			$redirect = "?type=courses";
		}
		
		if(Input::get('slug')!=""){
		$slug = Input::get('slug');
		} 
		//print_r($cat);
		$data->title = Input::get('title');
		$data->type = $type;
		$data->category = Input::get('cat');
		$data->slug = $slug;
		$data->publish = date('Y-m-d G:i:s');
		$data->option = Input::get('option');
		$data->flag = Input::get('status');
		$data->description = Input::get('desc');
		$data->save();
		 
		if(Input::get('id')==""){
			return Redirect::to('/listPost'.$redirect)->with('flash_notice', Input::get('title') . " Berhasil ditambahkan");
		}else{
			return Redirect::to('/listPost'.$redirect)->with('flash_notice', Input::get('title') . " Berhasil diedit");
		}
		
	}
	public  function addPage()
	{
		
		$edit = false;
		$post_edit =(object)array(
					'id'=>null,
					'title'=>null,
					'description'=>null,
					'category'=>null,
					'flag'=>'publish',
					);
		$cat = array();
		$post = Post::with('cat_item')->where('type','page')->get();
		if(isset($_GET['mode'])){
			if($_GET['mode']=="delete"){
				$post_delete = Post::find($_GET['id']);
				$title = $post_delete->title;
		        $post_delete->delete();
				return Redirect::to('/listPage')->with('flash_notice', $title . " Berhasil dihapus");
			}else{
				$edit = true;
				$post_edit = Post::with('cat_item')->where('type','page')->find($_GET['id']);
			}
			
		}		
		$data = array(
				'post'=>$post,
				'cat'=>$cat,				
				'tipe'=>'page',				
				'edit'=>$edit,				
				'post_edit'=>$post_edit,				
				);	
				
		$config = Config::get('admin');
	      
		$this->layout = View::make('sb_admin.master')->with('config',$config);
		$this->layout->content = View::make('sb_admin.addPage')->with('data',$data)->with('config',$config);
	}
	public  function addPageProses()
	{
		
		if(Input::get('id')==""){
			$data = new Post;
		}else{
			$data = Post::find(Input::get('id'));
		}
		
		$data->title = Input::get('title');
		$data->type = 'page';	
		$data->slug = Slugify::slugify(Input::get('title'));
		$data->publish = date('Y-m-d G:i:s');
		$data->option = '';
		$data->category = 0;
		$data->flag = Input::get('status');
		$data->description = Input::get('desc');
		$data->save();
		
		if(Input::get('id')==""){
			return Redirect::to('/listPage')->with('flash_notice', Input::get('title') . " Berhasil ditambahkan");
		}else{
			return Redirect::to('/listPage')->with('flash_notice', Input::get('title') . " Berhasil diedit");
		}
	}
public  function listCategory()
	{
		$data = array();
		
		$cat = Cat_item::orderBy('id','desc')->get();
		$data = array(
				'cat'=>$cat,				
				'type'=>'post',				
				'title'=>'List Category',				
				);	
		$config = Config::get('admin');
        
		$this->layout = View::make('sb_admin.master')->with('config',$config);	
		$this->layout->content = View::make('sb_admin.listCategory')->with('data',$data)->with('config',$config);
		
	}
public  function addCategory()
	{
		
		$edit = false;
		$cat_edit =(object)array(
					'id'=>null,
					'name'=>null,
					'type'=>'post',					
					);
		
		$cat = Cat_item::all();
		if(isset($_GET['mode'])){
			if($_GET['mode']=="delete"){
				$cat_delete = Cat_item::find($_GET['id']);
				$title = $cat_delete->title;
		        $cat_delete->delete();
				return Redirect::to('/listCategory')->with('flash_notice', $title . " Berhasil dihapus");
			}else{
				$edit = true;
				$cat_edit = Cat_item::find($_GET['id']);
			}
			
		}		
		$data = array(
				'cat'=>$cat,
				'edit'=>$edit,				
				'cat_edit'=>$cat_edit,				
				);	
				
		$config = Config::get('admin');
		$type = Config::get('admin.type');
		$module_type = Config::get('admin.module_type');
	    foreach ($type as  $t) {
			$types[$t] = $t;
		}
		foreach ($module_type as  $t) {
			$types[$t] = $t;
		}
		$this->layout = View::make('sb_admin.master')->with('config',$config);
		$this->layout->content = View::make('sb_admin.addCategory')->with('data',$data)
		->with('config',$config)->with('types',$types);
	}
public  function addCategoryProses()
	{
		
		if(Input::get('id')==""){
			$data = new Cat_item;
		}else{
			$data = Cat_item::find(Input::get('id'));
		}
		
		$data->name = Input::get('name');
		$data->type = Input::get('type');	
		$data->slug = Slugify::slugify(Input::get('name'));
	
		$data->save();
		
		if(Input::get('id')==""){
			return Redirect::to('/listCategory')->with('flash_notice', Input::get('title') . " Berhasil ditambahkan");
		}else{
			return Redirect::to('/listCategory')->with('flash_notice', Input::get('title') . " Berhasil diedit");
		}
	}
	
	public function upload(){
		$this->layout = "";
		$file = Input::file('file');
		
		$destinationPath =public_path().'/img/'; //Path in your public folder...
		$filename = $file->getClientOriginalName();
		Input::file('file')->move($destinationPath, $filename);
		echo URL::to('/img').'/'.$filename;
	}
	
	
	public function comment(){
		$config = Config::get('admin');
		$comment = array();
		if(isset($_GET['mode'])){
			if($_GET['mode']=="edit"){
				$comment = Post::find($_GET['id']);
			}else{
				$com_delete = Post::find($_GET['id']);
				
		        $com_delete->delete();
				return Redirect::to('/comment')->with('flash_notice',  "Komentar Berhasil dihapus");
			}
		}
		$data = Post::where('type','comment')->get();		
		  
		$this->layout = View::make('sb_admin.master')->with('config',$config);
		$this->layout->content = View::make('sb_admin.listComment')->with('data',$data)->with('config',$config)->with('commEdit',$comment);
	}
	
	
public  function editComment()
	{
		
		$info = array(
				'name'=>Input::get('commName'),
				'email'=>Input::get('commEmail'),
				'website'=>Input::get('commWeb'),
				);		
		$data = Post::find(Input::get('id'));		
		$data->publish = date('Y-m-d G:i:s');	
		$data->flag = Input::get('status');	
		$data->description = Input::get('commDesc');
		$data->option = json_encode($info);
	
		$data->save();
		
			
		return Redirect::to('/comment')->with('flash_notice', "Komentar Berhasil di edit");
		
	}
	
	public function login()
	{
		$config = Config::get('blog');
                
				$this->layout = View::make('sb_admin.master')->with('config',$config);
		$this->layout->content = View::make('sb_admin.login')->with('config',$config);
	}
	
	public function loginProses()
	{
		$auth = Auth::attempt(
            [
                'username'  => strtolower(Input::get('username')),
                'password'  => Input::get('password')    
            ]
        );
        if ($auth) {
            return Redirect::to('/admin')->with('flash_notice', 'Selamat Datang '.Auth::user()->username);
        } else {
            // validation not successful, send back to form 
            return Redirect::to('/login')
                ->withInput(Input::except('password'))
                ->with('flash_notice', 'Your username/password combination was incorrect.');
        }
	}
	
	public function setting()
	{
		$data = array();
		$config = Config::get('admin');
		$config_blog = Config::get('blog');		
		$theme = array_map('basename', File::directories(Theme::publicPath()));
		
		foreach($theme as $th){
			$themes[$th] = $th;
		}
		
        
			if(isset($_GET['action'])){
			
					$avatar =  Input::get('avatar2');					
					if(Input::file('avatar')){ 
					$file = Input::file('avatar');		
					$destinationPath =public_path().'/img/'; //Path in your public folder...
					$filename = $file->getClientOriginalName();
					Input::file('avatar')->move($destinationPath, $filename);
					$avatar =  URL::to('/img').'/'.$filename;
					}
					
					$file = '<?php 
	return array( 
	"list_item"=>"'.Input::get('list_item').'", 
	"author"=>"'.Input::get('author').'",
	"blog_name"=>"'.Input::get('blog_name').'",
	"description"=>"'.Input::get('description').'",
	"tag_line"=>"'.Input::get('tag_line').'",
	"keyword"=>"'.Input::get('keyword').'",
	"alias"=>"'.Input::get('alias').'",
	"avatar"=>"'.$avatar.'",
	"comment"=>"'.Input::get('comment').'",
	"twitter"=>"'.Input::get('twitter').'",
	"facebook"=>"'.Input::get('facebook').'",
	"google+"=>"'.Input::get('google+').'",
	"theme"=>"'.Input::get('theme').'",
	"menu"=>array(';
foreach($_POST['menu']['name'] as $index=>$name){
		$link = $_POST['menu']['link'][$index];
		$file .='"'.$name.'"=>"'.$link.'",';
		}
$file .='),
	"menu_child1"=>array(';
	if(isset($_POST['menu_child1'] )){
	foreach($_POST['menu_child1'] as $index1 => $child1){
		$file .='"'.$index1.'"=>array(';
		foreach($child1['name'] as $index_child1=>$name_child1){
			//print_r($_POST['menu_child1'][$index1]['name']);
			if($name_child1!=""){				
			$link = $_POST['menu_child1'][$index1]['link'][$index_child1];
			$file .='"'.$name_child1.'"=>"'.$link.'",';
			}
			/*$link = $_POST['menu_child1']['link'][$index];
			$file .='"'.$name.'"=>"'.$link.'",';	*/	
			//$file .=$name_child1;
		}
		$file .='),';
	}
	}
$file .=')
	);';	
	
	//echo $file;				
					$file_config = app_path().'/config/blog.php';	
					$save = File::put($file_config, $file);	
					//echo $avatar ;  
						if($save) return Redirect::to('setting')->with('flash_notice', 'Setting Berhasil di Update');
			}else{
				
				$this->layout = View::make('sb_admin.master')->with('config',$config);
				$this->layout->content = View::make('sb_admin.setting')->with('data',$data)
				->with('config',$config)->with('config_blog',$config_blog)->with('themes',$themes);
			}
	
	}

	public function menuPick(){
		$data = array();
		$q=$_GET['term'];
		$posts = Post::with('cat_item')->where('type','post')->where('title','like','%'.$q.'%')->get();
		$pages = Post::where('type','page')->where('title','like','%'.$q.'%')->get();
		$cats = Cat_item::where('type','post')->where('name','like','%'.$q.'%')->get();
		$prod_cats = Cat_item::where('type','product')->where('name','like','%'.$q.'%')->get();	
		$products = Post::with('cat_item')->where('type','product')->where('title','like','%'.$q.'%')->get();	
		//print_r( DB::getQueryLog());
		foreach($posts as $post){
			$data[]  = array('id' => $post->id ,'label'=>'[POST] '.$post->title,'value'=>'article/'.$post->cat_item->slug.'/'.$post->slug);
			// /echo $data->id;
		}	
		foreach($products as $product){
			$data[]  = array('id' => $product->id ,'label'=>'[PRODUCT] '.$product->title,'value'=>'product/'.$product->cat_item->slug.'/'.$product->slug);
			// /echo $data->id;
		}	
		foreach($pages as $page){
			$data[]  = array('id' => $page->id ,'label'=>'[PAGE] '.$page->title,'value'=>'page/'.$page->slug);
			// /echo $data->id;
		}		
		foreach($cats as $cat){
			$data[]  = array('id' => $cat->id ,'label'=>'[POST CAT] '.$cat->name,'value'=>'category/'.$cat->slug);
			// /echo $data->id;
		}
		foreach($prod_cats as $prod_cat){
			$data[]  = array('id' => $prod_cat->id ,'label'=>'[PRODUCT CAT] '.$prod_cat->name,'value'=>'product_cat/'.$prod_cat->slug);
			// /echo $data->id;
		}
		echo json_encode($data);
	}
	
	public function addProduct()
	{
		$data = array();
		$edit = false;
		$post_option = array(
					'spec'=>null,
					'price'=>null,
					'img'=>array(
						1 =>null,
						2 =>null,
						3 =>null,
						4 =>null,
					)
		);
		$post_edit =(object)array(
					'id'=>null,
					'title'=>null,
					'slug'=>null,
					'description'=>null,
					'category'=>null,
					'option'=>null,
					'spec'=>null,
					'price'=>0,
					'flag'=>'publish',
					);
		
		$cat = Cat_item::where('type','product')->get();
		$post = Post::with('cat_item')->where('type','product')->get();
		if(isset($_GET['mode'])){
			if($_GET['mode']=="delete"){
				$post_delete = Post::find($_GET['id']);
				$title = $post_delete->title;
		        $post_delete->delete();
				return Redirect::to('/listProduct')->with('flash_notice', $title . " Berhasil dihapus");
			}else{
				$edit = true;
				
				$post_edit = Post::with('cat_item')->find($_GET['id']);
				$post_option = json_decode($post_edit->option,true);
			}
			
		}		
		$data = array(
				'post'=>$post,
				'cat'=>$cat,			
				'edit'=>$edit,				
				'post_edit'=>$post_edit,				
				'post_option'=>$post_option,				
				);	 
		$config = Config::get('admin');
    	 //print_r($post_option);
		$this->layout = View::make('sb_admin.master')->with('config',$config);
		$this->layout->content = View::make('sb_admin.addProduct')->with('data',$data)->with('config',$config);
	}
	
	
	public  function addProductProses()
	{
		if(Input::get('id')==""){
			$data = new Post;
		}else{
			$data = Post::find(Input::get('id'));
		}
		$type = "product";
		$redirect = "";
		$slug = Slugify::slugify(Input::get('title'));
		$cat = Cat_item::find(Input::get('cat'));
		$destinationPath =public_path().'/img/product/'; //Path in your public folder...
		
		for($i=1;$i<=4;$i++){
			$img[$i] =  Input::get('img_hidden'.$i);					
			if(Input::file('img'.$i)){
				 
			$file[$i] = Input::file('img'.$i);			
			$filename[$i] = $file[$i]->getClientOriginalName();
			Input::file('img'.$i)->move($destinationPath, $filename[$i]);
			$img[$i]  =  $filename[$i];
			}
			
		}	
		
		//print_r(Input::all());
		
		$option = array(
			'price' => Input::get('price'),
			'spec' => Input::get('spec'),
			'img' => $img,
		);
		
		if(Input::get('slug')!=""){
		$slug = Input::get('slug');
		} 
		//print_r($cat);
		$data->title = Input::get('title');
		$data->type = $type;
		$data->category = Input::get('cat');
		$data->slug = $slug;
		$data->publish = date('Y-m-d G:i:s');
		$data->option = json_encode($option);
		$data->flag = Input::get('status');
		$data->description = Input::get('desc');
		$data->save();
		 
		if(Input::get('id')==""){
			return Redirect::to('/listProduct'.$redirect)->with('flash_notice', Input::get('title') . " Berhasil ditambahkan");
		}else{
			return Redirect::to('/listProduct'.$redirect)->with('flash_notice', Input::get('title') . " Berhasil diedit");
		}
		
	}
	public function listProduct(){
		$data = array();

		$post = Post::with('cat_item')->where('type','product')->orderBy('id','desc')->get();
		
		$data = array(
				'post'=>$post,				
				'type'=>'product',				
				'title'=>'List product ',				
				);	
		$config = Config::get('admin');
		
		$this->layout = View::make('sb_admin.master')->with('config',$config);		
		$this->layout->content = View::make('sb_admin.listProduct')->with('data',$data)->with('config',$config);
	}
	public function listModule(){
		$data = array();
		
		$module = Post::with('cat_item')->where('type', $_GET['type'])->get();
		$data = array(
				'module'=>$module,				
				'type'=>$_GET['type'],				
						
				);	
		$config = Config::get('admin');
		//print_r($post);
		$this->layout = View::make('sb_admin.master')->with('config',$config);		
		$this->layout->content = View::make('sb_admin.listModule')->with('data',$data)->with('config',$config);
	}
	
	public function addModule()
	{
		if(!isset($_GET['type'])){			
			return Redirect::to('/admin')->with('flash_notice',  " Halaman yang anda maksud belum tersedia ");
		}
		$type = $_GET['type'];
		$data = array();
		$edit = false;
		$post_option = array(
					'img'=>null	,			
					'link'=>null,			
					);
		$post_edit =(object)array(
					'id'=>null,
					'title'=>null,
					'slug'=>null,
					'description'=>null,
					'category'=>null,
					'option'=>null,
					'spec'=>null,
					'price'=>0,
					'flag'=>'publish',
					);
		
		$cat = Cat_item::where('type',$type)->get();
		
		if(!count($cat)){			
			return Redirect::to('/admin')->with('flash_notice',  " Kategori untuk module " . ucfirst($type) . " belum dibuat ");
		}
		$post = Post::with('cat_item')->where('type',$type)->get();
		if(isset($_GET['mode'])){
			if($_GET['mode']=="delete"){
				$post_delete = Post::find($_GET['id']);
				$title = $post_delete->title;
		        $post_delete->delete();
				return Redirect::to('/module?type='.$type)->with('flash_notice', $title . " Berhasil dihapus");
			}else{
				$edit = true;
				
				$post_edit = Post::with('cat_item')->find($_GET['id']);
				$post_option = json_decode($post_edit->option,true);
			}
			
		}		
		$data = array(
				'post'=>$post,
				'cat'=>$cat,			
				'edit'=>$edit,				
				'post_edit'=>$post_edit,				
				'post_option'=>$post_option,				
				);	 
		$config = Config::get('admin');
    	 //print_r($post_option);
		$this->layout = View::make('sb_admin.master')->with('config',$config);
		$this->layout->content = View::make('sb_admin.addModule')->with('data',$data)->with('config',$config);
	}

public  function addModuleProses()
	{
		$type = Input::get('type');
		if(Input::get('id')==""){
			$data = new Post;
		}else{
			$data = Post::find(Input::get('id'));
		}
		
		$redirect = "";
		$slug = Slugify::slugify(Input::get('title'));
		$cat = Cat_item::find(Input::get('cat'));
		$destinationPath =public_path().'/img/'.$type.'/'; //Path in your public folder...
		
	
			$img =  Input::get('img_hidden');					
			if(Input::file('img')){				 
			$file = Input::file('img');			
			$filename = $file->getClientOriginalName();
			Input::file('img')->move($destinationPath, $filename);
			$img =  $filename;
			}
	
		//print_r(Input::all());
		
		$option = array(		
			'img' => $img,
			'link' => Input::get('link'),
		);
		
		if(Input::get('slug')!=""){
		$slug = Input::get('slug');
		} 
		//print_r($cat);
		$data->title = Input::get('title');
		$data->type = $type;
		$data->category = Input::get('cat');
		$data->slug = $slug;
		$data->publish = date('Y-m-d G:i:s');
		$data->option = json_encode($option);
		$data->flag = Input::get('status');
		$data->description = Input::get('desc');
		$data->save();
		 
		if(Input::get('id')==""){
			$msg = " Berhasil ditambahkan";
		}else{
			$msg = " Berhasil diedit";
		}
		return Redirect::to('/module?type='.$type)->with('flash_notice', Input::get('title') . $msg);
		
	}
	
}
