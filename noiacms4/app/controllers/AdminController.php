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
		$config = Config::get('blog');
        Theme::init('default');  	
		
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
		$config = Config::get('blog');
		Theme::init('default');  
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
		$config = Config::get('blog');
        Theme::init('default');  
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
				
		$config = Config::get('blog');
         Theme::init('default');  
		$this->layout = View::make('sb_admin.master')->with('config',$config); 		
		$this->layout->content = View::make('sb_admin.addUser')->with('data',$data)->with('config',$config);
		
		//print_r($data);
	}
	
	public function listUser()
	{
		$data = array();
		
		$user = Pengguna::all();
	
		$config = Config::get('blog');
       Theme::init('default');  
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
				
		$config = Config::get('blog');
	      Theme::init('default');  
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
		$config = Config::get('blog');
        Theme::init('default');  
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
				
		$config = Config::get('blog');
	    Theme::init('default');  
		$this->layout = View::make('sb_admin.master')->with('config',$config);
		$this->layout->content = View::make('sb_admin.addCategory')->with('data',$data)->with('config',$config);
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
		$config = Config::get('blog');
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
		  Theme::init('default');  
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
                Theme::init('default');  
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
		$config = Config::get('blog');
        Theme::init('default');  	
		
		$this->layout = View::make('sb_admin.master')->with('config',$config);
		$this->layout->content = View::make('sb_admin.setting')->with('data',$data)->with('config',$config);
	}
	/*
	 public function catCourses($cat_item){
		$limit = Config::get('blog.list_item');
		$offset = 0;
		if(isset($_GET['limit'])){
			$offset = $_GET['limit'];
		}
		
		if(isset($_GET['page'])){
			$offset = $limit * ($_GET['page']-1);
		}
		
		$data = Post::with('cat_item')->whereHas('cat_item', function($q) use ($cat_item){
		    $q->where('slug', $cat_item );		
			})->where('type','courses')->where('flag','publish')->get();
		
		$config = Config::get('blog');
		$cat = Cat_item::where('slug',$cat_item)->first();
		$cat_all = Cat_item::where('type',"courses")->get();
        Theme::init('default');  
		$this->layout = View::make('master')->with('config',$config);
		$this->layout->content = View::make('listCourses')->with('data',$data)->with('config',$config)->with('category',$cat)->with('cat_all',$cat_all);
	
	}*/


}
