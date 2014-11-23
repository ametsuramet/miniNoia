<?php

class HomeController extends BaseController {

//protected $layout ="master";

	public function index(){
		
		
		$data =array();		
		$limit = Config::get('blog.list_item');
		$offset = 0;
		if(isset($_GET['limit'])){
			$offset = $_GET['limit'];
		}
		
		if(isset($_GET['page'])){
			$offset = $limit * ($_GET['page']-1);
		}
		
		$data = Post::with('cat_item')->where('type','post');
		if(isset($_GET['search'])){
			$data = $data->where('title','like','%'.$_GET['search'].'%')->orWhere('description','like','%'.$_GET['search'].'%')->orWhere('option','like','%'.$_GET['search'].'%');
		}	 
		$data = $data->where('flag','publish')->orderBy('id','desc')->take($limit)->skip($offset)->get();
		//print_r( DB::getQueryLog());
		
		$config = Config::get('blog');
		Theme::init('default');  
		$this->layout = View::make('master')->with('config',$config);
		$this->layout->content = View::make('home')->with('data',$data)->with('config',$config);
		
		
	}
	
	public function listCourses(){
		
		
		$data =array();		
		$limit = Config::get('blog.list_item');
		$offset = 0;
		if(isset($_GET['limit'])){
			$offset = $_GET['limit'];
		}
		
		if(isset($_GET['page'])){
			$offset = $limit * ($_GET['page']-1);
		}
		
		$data = Post::with('cat_item')->where('type','courses');
		if(isset($_GET['search'])){
			$data = $data->where('title','like','%'.$_GET['search'].'%')->orWhere('description','like','%'.$_GET['search'].'%')->orWhere('option','like','%'.$_GET['search'].'%');
		}	 
		$data = $data->where('flag','publish')->orderBy('id','desc')->take($limit)->skip($offset)->get();
		//print_r( DB::getQueryLog());
		$cat_all = Cat_item::where('type',"courses")->get();
		$config = Config::get('blog');
		Theme::init('default');  
		$this->layout = View::make('master')->with('config',$config);
		$this->layout->content = View::make('listCourses')->with('data',$data)->with('config',$config)->with('cat_all',$cat_all);
		
		
	}
	public function category($cat_item){
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
			})->where('type','post')->where('flag','publish')->orderBy('id','desc')->get();
		
		$config = Config::get('blog');
		$cat = Cat_item::where('slug',$cat_item)->first();
        Theme::init('default');    
		$this->layout = View::make('master')->with('config',$config);
		$this->layout->content = View::make('category')->with('data',$data)->with('config',$config)->with('category',$cat);
	
	}
	
	
	
/*	public function  show($id)
	{

		$data = Post::with('cat_item')->where('type','post')->where('flag','publish')->find($id);
		
		$config = Config::get('blog');
		$comment = Post::where('type','post')->where('flag','publish')->find($data->id);
		 Theme::init('default');  
		$this->layout = View::make('master')->with('config',$config);
		$this->layout->content = View::make('post')->with('data',$data)->with('config',$config)->with('comment',$comment);
	}*/
	public function article($cat_item,$post){
		$type = "post";
		if(isset($_GET['type'])) $type = $_GET['type'];
		$data = Post::with('cat_item')->where('slug',$post)->whereHas('cat_item', function($q) use ($cat_item){
		    $q->where('slug', $cat_item );		
			})->where('type',$type)->first();
		$data->increment('hit', 1);
		//print_r($data);
		$config = Config::get('blog');
		$comment = Post::where('type','comment')->where('flag','publish')->where('category',$data->id)->get();
		// /print_r( DB::getQueryLog());
		Theme::init('default');  
		$this->layout = View::make('master')->with('config',$config);
		$this->layout->content = View::make('post')->with('post',$data)->with('config',$config)->with('comment',$comment);
	}
	
	public function page($post){
		
		$data = Post::where('slug',$post)->where('type','page')->first();
		$comment = array();
		$config = Config::get('blog');
		Theme::init('default');  
		$this->layout = View::make('master')->with('config',$config);
		$this->layout->content = View::make('post')->with('post',$data)->with('config',$config)->with('comment',$comment);
	}
	
	
public  function addComment()
	{
		
		
		$post = Post::with('cat_item')->where('type',Input::get('type'))->where('id',Input::get('id'))->first();
		
		if(!filter_var(Input::get('commEmail'), FILTER_VALIDATE_EMAIL))
		  {
		  return Redirect::back()->withInput()->with('flash_notice', 'email tidak valid');
		  }
		  
		
		if(Input::get('commName')=="" && Input::get('commEmail')){	
		return Redirect::to('/article/'.$post->cat_item->slug.'/'.$post->slug)->with('flash_notice', "ERROR! Pastikan anda mengisi form nama dan email");
		}
		
		$info = array(
				'name'=>Input::get('commName'),
				'email'=>Input::get('commEmail'),
				'website'=>Input::get('commWeb'),
				);
		
		$data = new Post;
		
		$data->title = '';	
		$data->publish = '';	
		$data->type = 'comment';	
		$data->category = Input::get('id');	
		$data->flag = 'draft';	
		$data->description = Input::get('commDesc');
		$data->option = json_encode($info);
	
		$data->save();
		//print_r($post);
		$type = "";
		if(Input::get('type')=="courses"){
			$type = "?type=courses";
		}
		return Redirect::to('/article/'.$post->cat_item->slug.'/'.$post->slug.$type)->with('flash_notice', "Komentar Berhasil ditambahkan dan akan ditampilkan setelah dimoderasi terlebih dahulu");
		
		
	}
	
	

}