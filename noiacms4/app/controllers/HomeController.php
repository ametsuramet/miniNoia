<?php

class HomeController extends BaseController {

//protected $layout ="master";

	public function index(){
		
		$param = array("address"=>"cigondewah rahayu bandung");
		
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
		$add_module = Config::get('admin.module_type');
		$conf_module = Config::get('module');		
		
		foreach($conf_module['home'] as $index=>$mod){	
			$module[$index] = $this->module($index,$mod['type'],$mod['limit'],$mod['offset'],'publish','id','desc');			
		}		
		$html = Post::with('cat_item')->where('type','html')->where('flag','publish')->get();
		foreach($html as $index=>$mod){	
			$module['singleHTML'][$mod->slug] = $mod->description;		
		}
		//print_r($module);
		$offset = 0;		
		$product = Post::with('cat_item')->where('type','product')->where('flag','publish')
		->take($limit)->skip($offset)->orderBy('id','desc')->get();
			
		$contact = Config::get('admin.contact');	
		//print_r($add_modules);
		$config = Config::get('blog');
		
		Theme::init(Config::get('blog.theme'));  
		$this->layout = View::make('master')->with('config',$config)->with('module',$module);
		$this->layout->content = View::make('home')->with('data',$data)->with('config',$config)
		->with('module',$module)->with('contact',$contact);
		
		
	}
	
	public function show_module($type,$slug){
		$data = Post::with('cat_item')->where('type','html')->where('slug',$slug)->first();
		//print_r( DB::getQueryLog());
		//print_r($data);
		echo $data->description;
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
		$conf_module = Config::get('module');		
		
		foreach($conf_module['home'] as $index=>$mod){	
			$module[$index] = $this->module($index,$mod['type'],$mod['limit'],$mod['offset'],'publish','id','desc');			
		}		
		$html = Post::with('cat_item')->where('type','html')->where('flag','publish')->get();
		foreach($html as $index=>$mod){	
			$module['singleHTML'][$mod->slug] = $mod->description;		
		}
		Theme::init(Config::get('blog.theme'));  
		$this->layout = View::make('master')->with('config',$config);
		$this->layout->content = View::make('listCourses')->with('data',$data)
		->with('module',$module)->with('config',$config)->with('cat_all',$cat_all);
		
		
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
				if($cat_item!="all"){
			   		$q->where('slug', $cat_item );		
			    }
			})->where('type','post')->where('flag','publish')->take($limit)->skip($offset)->orderBy('id','desc')->get();
		
		$conf_module = Config::get('module');
		foreach($conf_module['post'] as $index=>$mod){
			$module[$index] = $this->module($index,$mod['type'],$mod['limit'],$mod['offset'],'publish');
			
		}
		$html = Post::with('cat_item')->where('type','html')->where('flag','publish')->get();
		foreach($html as $index=>$mod){	
			$module['singleHTML'][$mod->slug] = $mod->description;		
		}
		$config = Config::get('blog');
		$cat = Cat_item::where('slug',$cat_item)->first();
		$all_cat = Cat_item::where('type','post')->get();
        Theme::init(Config::get('blog.theme'));    
		$this->layout = View::make('master')->with('config',$config)->with('module',$module);
		$this->layout->content = View::make('category')->with('data',$data)->with('all_cat',$all_cat)
		->with('config',$config)->with('category',$cat)->with('module',$module);
	
	}
	public function gallery($cat_item){
		$limit = Config::get('blog.list_item');
		
		$offset = 0;
		if(isset($_GET['limit'])){
			$offset = $_GET['limit'];
		}
		
		if(isset($_GET['page'])){
			$offset = $limit * ($_GET['page']-1);
		}
		
		$data = Post::with('cat_item')->whereHas('cat_item', function($q) use ($cat_item){
				if($cat_item!="all"){
			   		$q->where('slug', $cat_item );		
			    }
			})->where('type','gallery')->where('flag','publish')->take($limit)->skip($offset)->orderBy('id','desc')->get();
		
		$conf_module = Config::get('module');
		foreach($conf_module['post'] as $index=>$mod){
			$module[$index] = $this->module($index,$mod['type'],$mod['limit'],$mod['offset'],'publish');
			
		}
		$html = Post::with('cat_item')->where('type','html')->where('flag','publish')->get();
		foreach($html as $index=>$mod){	
			$module['singleHTML'][$mod->slug] = $mod->description;		
		}
		$config = Config::get('blog');
		$cat = Cat_item::where('slug',$cat_item)->first();
		$all_cat = Cat_item::where('type','gallery')->get();
        Theme::init(Config::get('blog.theme'));    
		$this->layout = View::make('master')->with('config',$config)->with('module',$module);
		$this->layout->content = View::make('gallery')->with('data',$data)->with('config',$config)
		->with('category',$cat)->with('all_cat',$all_cat)->with('module',$module);
	
	}

	public function product_category($cat_item){
		$limit = Config::get('blog.list_item');		
		$offset = 0;
		if(isset($_GET['limit'])){
			$offset = $_GET['limit'];
		}
		
		if(isset($_GET['page'])){
			$offset = $limit * ($_GET['page']-1);
		}
		
		$data = Post::with('cat_item')->whereHas('cat_item', function($q) use ($cat_item){
		    if($cat_item!="all"){
			   		$q->where('slug', $cat_item );		
			    }
			})->where('type','product')->where('flag','publish')->take($limit)->skip($offset)->orderBy('id','desc')->get();
		
		$conf_module = Config::get('module');
		foreach($conf_module['category_product'] as $index=>$mod){
			$module[$index] = $this->module($index,$mod['type'],$mod['limit'],$mod['offset'],'publish');
			
		}
		$html = Post::with('cat_item')->where('type','html')->where('flag','publish')->get();
		foreach($html as $index=>$mod){	
			$module['singleHTML'][$mod->slug] = $mod->description;		
		}
		$config = Config::get('blog');
		$cat = Cat_item::where('slug',$cat_item)->first();
		$all_cat = Cat_item::where('type','product')->get();
        Theme::init(Config::get('blog.theme'));    
		$this->layout = View::make('master')->with('config',$config)->with('module',$module);
		$this->layout->content = View::make('product_category')
		->with('data',$data)->with('config',$config)->with('all_cat',$all_cat)->with('category',$cat)->with('module',$module);
	
	}
	public function product($cat_item,$post){
		$type = "product";
		if(isset($_GET['type'])) $type = $_GET['type'];
		$data = Post::with('cat_item')->where('slug',$post)->whereHas('cat_item', function($q) use ($cat_item){
		    $q->where('slug', $cat_item );		
			})->where('type',$type)->first();
		$data->increment('hit', 1);
		//print_r($data);
		$config = Config::get('blog');
		$comment = Post::where('type','comment')->where('flag','publish')->where('category',$data->id)->get();
		// /print_r( DB::getQueryLog());
		
		$conf_module = Config::get('module');
		foreach($conf_module['product'] as $index=>$mod){
			$module[$index] = $this->module($index,$mod['type'],$mod['limit'],$mod['offset'],'publish');
			
		}
		$html = Post::with('cat_item')->where('type','html')->where('flag','publish')->get();
		foreach($html as $index=>$mod){	
			$module['singleHTML'][$mod->slug] = $mod->description;		
		}
		//print_r($module['random_product']);
		Theme::init(Config::get('blog.theme'));  
		$this->layout = View::make('master')->with('config',$config)->with('module',$module);
		$this->layout->content = View::make('product')->with('post',$data)->with('config',$config)->with('module',$module)->with('comment',$comment);
	}
	
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
		
		$conf_module = Config::get('module');
		foreach($conf_module['post'] as $index=>$mod){
			$module[$index] = $this->module($index,$mod['type'],$mod['limit'],$mod['offset'],'publish');
			
		}
		$html = Post::with('cat_item')->where('type','html')->where('flag','publish')->get();
		foreach($html as $index=>$mod){	
			$module['singleHTML'][$mod->slug] = $mod->description;		
		}
		//print_r($module['random_product']);
		Theme::init(Config::get('blog.theme'));  
		$this->layout = View::make('master')->with('config',$config)->with('module',$module);
		$this->layout->content = View::make('post')->with('post',$data)->with('config',$config)->with('module',$module)->with('comment',$comment);
	}
	
	public function page($post){
		
		$data = Post::where('slug',$post)->where('type','page')->first();
		$comment = array();
		$config = Config::get('blog');
		$conf_module = Config::get('module');
		foreach($conf_module['page'] as $index=>$mod){
			$module[$index] = $this->module($index,$mod['type'],$mod['limit'],$mod['offset'],'publish');
			
		}
		$html = Post::with('cat_item')->where('type','html')->where('flag','publish')->get();
		foreach($html as $index=>$mod){	
			$module['singleHTML'][$mod->slug] = $mod->description;		
		}
		Theme::init(Config::get('blog.theme'));  
		$this->layout = View::make('master')->with('config',$config)->with('module',$module);
		$this->layout->content = View::make('post')->with('post',$data)->with('config',$config)->with('comment',$comment)->with('module',$module);
	}
	
	
public  function addComment()
	{
		
		if(Input::get('captcha')==""){
			return Redirect::back()->with('flash_notice', "Security Code Kosong");	
		}
		$rules = [
            'commName' => 'required|min:3',         
            'commEmail' => 'required|email',
            'captcha' => 'captcha'
           
        ];

        $input = Input::only(
            'commName',            
            'commEmail',
            'captcha'
           
        );
		
        $validator = Validator::make($input, $rules);
		
		if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
            //print_r($validator);
        }
		
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
		if(Input::get('type')=="product"){
			return Redirect::to('/product/'.$post->cat_item->slug.'/'.$post->slug)->with('flash_notice', "Komentar Berhasil ditambahkan dan akan ditampilkan setelah dimoderasi terlebih dahulu");
			
		}elseif(Input::get('type')=="courses"){
			$type = "?type=courses";
		return Redirect::to('/article/'.$post->cat_item->slug.'/'.$post->slug.$type)->with('flash_notice', "Komentar Berhasil ditambahkan dan akan ditampilkan setelah dimoderasi terlebih dahulu");
		}
		
	}
	
	public function module($name,$type,$limit=null,$offset=null,$publish="publish",$by="id",$order="desc"){
		$data = array();
		switch ($name) {
			case 'post':
			case 'product':	
			case 'gallery':					
			case 'testimonial':					
			case 'slider':			
			case 'html':			
				$data = Post::with('cat_item')->where('type',$type)->where('flag',$publish)->orderBy($by, $order);
				if($limit)
				$data = $data->take($limit);
				if($offset)
				$data = $data->skip($offset);
				$data = $data->get();
				break;			
			case 'popular_product':			
				$data = Post::with('cat_item')->where('type',$type)->where('flag',$publish)->orderBy("hit", "desc");
				if($limit)
				$data = $data->take($limit);
				if($offset)
				$data = $data->skip($offset);
				$data = $data->get();
				
				break;	
			case 'random_product':			
				
				$data = Post::with('cat_item')->where('type',$type)->orderByRaw('rand()')->where('flag',$publish);
				if($limit)
				$data = $data->take($limit);
				if($offset)
				$data = $data->skip($offset);
				$data = $data->get();				
				break;	
			case 'category_product':			
				
				$data = Cat_item::where('type',$type);
				
				$data = $data->get();				
				break;				
				default:
				$data = array();
				break;
		}
		//return DB::getQueryLog();
		return $data;
		
	}

	public function search_ajax(){
		$data = array();
		$q=$_GET['term'];
	
		
		$posts = Post::with('cat_item')->where('type','post')->where('title','like','%'.$q.'%')->get();
		$pages = Post::where('type','page')->where('title','like','%'.$q.'%')->get();
		$categories = Cat_item::where('type','post')->where('name','like','%'.$q.'%')->get();
		$prod_cats = Cat_item::where('type','product')->where('name','like','%'.$q.'%')->get();	
		$products = Post::with('cat_item')->where('type','product')->where('title','like','%'.$q.'%')->get();	
		//print_r( DB::getQueryLog());
		foreach($posts as $post){
			$cat = $post->cat_item->slug;			
			$img = "";
			$isi = "";
			$harga = "";
			$data[]  = array('cat'=>$cat,'img'=>$img,'isi'=>$isi,'harga'=>$harga,'id' => $post->id ,'label'=>''.$post->title,'value'=>'article/'.$post->cat_item->slug.'/'.$post->slug);
			// /echo $data->id;
		}	
		foreach($products as $product){
			$product_option = json_decode($product->option,true);
			if($product_option['img'][1]!=""){
				$img="<div class='search_thumb'><img  src='".URL::to('/img/product/')."/".$product_option['img'][1]."' /> </div>";
			}
			$harga ='IDR '.	number_format( $product_option['price'],0,",",".");
			$cat = $product->cat_item->slug;
		
			$isi = "";
		
			$data[]  = array('cat'=>$cat,'img'=>$img,'isi'=>$isi,'harga'=>$harga,'id' => $product->id ,'label'=>''.$product->title,'value'=>'product/'.$product->cat_item->slug.'/'.$product->slug);
			// /echo $data->id;
		}	
		foreach($pages as $page){
			$cat = "";
			$img = "";
			$isi = "";
			$harga = "";
			$data[]  = array('cat'=>$cat,'img'=>$img,'isi'=>$isi,'harga'=>$harga,'id' => $page->id ,'label'=>''.$page->title,'value'=>'page/'.$page->slug);
			// /echo $data->id;
		}		
		foreach($categories as $category){
			$cat = "";
			$img = "";
			$isi = "";
			$harga = "";
			$data[]  = array('cat'=>$cat,'img'=>$img,'isi'=>$isi,'harga'=>$harga,'id' => $category->id ,'label'=>''.$category->name,'value'=>'category/'.$category->slug);
			// /echo $data->id;
		}
		foreach($prod_cats as $prod_cat){
			$cat = "";
			$img = "";
			$isi = "";
			$harga = "";
			$data[]  = array('cat'=>$cat,'img'=>$img,'isi'=>$isi,'harga'=>$harga,'id' => $prod_cat->id ,'label'=>''.$prod_cat->name,'value'=>'product_cat/'.$prod_cat->slug);
			// /echo $data->id;
		}
		echo json_encode($data);
	}
	
	public function sendContact(){
		//NOTE : Please set EMAIL config at noiacms4/app/config/mail.php
		$config = Config::get('blog');
		$contact = Config::get('admin.contact');
		$style = Config::get('admin.contact_style');
		$contact_msg = Config::get('admin.contact_msg');
		$contact_to = Config::get('admin.contact_to');
		$send = null;
		if(Input::get('captcha')==""){
			return Redirect::back()->with('flash_notice', "Security Code Kosong");	
		}
		$rules = [
            'name' => 'required|min:3',
            'phone' => 'required|numeric|digits_between:8,25',
            'email' => 'required|email',
            'captcha' => 'captcha'
           
        ];

        $input = Input::only(
            'name',
            'phone',
            'email',
            'captcha'
           
        );
		
        $validator = Validator::make($input, $rules);
		
		if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
            //print_r($validator);
        }
		
		
		$send .="<html><body ".$style['body'].">";		
		$send .="<div ".$style['box'].">";		
		$send .="<h3 ".$style['heading1']." >".$config['blog_name']."</h3>";		
		$send .="<h4 ".$style['heading2']." >Contact Form Responder</h4>";		
		$message = Input::all();
		$i = 0;
		foreach($message as $index=>$msg){
			$send .= '<label '.$style['label'].'>'.$contact[$i][1] ." </label> <span ".$style['msg_cont']."> ". $msg .'</span><br>';
		$i++;
		}
		$send .="</div>";	
		$send .="<small ".$style['footer'].">&copy 2014 - <a href='http://ametw.hol.es'>amet suramet</a></small>";	
		$send .="</body></html>";	
		//echo $send;
		Theme::init(Config::get('blog.theme'));  
		//return View::make('email')->with('msg',$send);
		$input = $_POST;
		Mail::send('email', array('msg' => $send ), function($message) use ($config,$contact_to,$contact_msg,$input)
		{
		    $message->to($contact_to['send_email'],$contact_to['send_name'])->subject($config['blog_name']." Contact Form Responder");
			$message->replyTo($input['email'],$input['name']);
			//echo "aye";
			
		});	
		
		return Redirect::back()->with('flash_notice', $contact_msg['success']);	
	}

}