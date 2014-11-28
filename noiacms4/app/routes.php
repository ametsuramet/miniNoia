<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(array('before' => 'auth'), function()
{
    Route::get('/listPost',array('uses'=>'AdminController@listPost'));
	Route::get('tambahUser',array('uses'=>'AdminController@tambahUser'));
	Route::get('listPage',array('uses'=>'AdminController@listPage'));
	Route::post('EditComment',array('uses'=>'AdminController@editComment'));
	Route::get('admin',array('uses'=>'AdminController@admin'));
	Route::post('addPost',array('uses'=>'AdminController@addPost'));
	Route::get('addPage',array('uses'=>'AdminController@addPage'));
	Route::post('addPage',array('uses'=>'AdminController@addPageProses'));
	Route::get('addProduct',array('uses'=>'AdminController@addProduct'));
	Route::post('addProduct',array('uses'=>'AdminController@addProductProses'));
	Route::get('listProduct',array('uses'=>'AdminController@listProduct'));
	Route::get('listCategory',array('uses'=>'AdminController@listCategory'));
	Route::get('addCategory',array('uses'=>'AdminController@addCategory'));
	Route::post('upload',array('uses'=>'AdminController@upload'));
	Route::post('addCategory',array('uses'=>'AdminController@addCategoryProses'));
	Route::get('listUser',array('uses'=>'AdminController@listUser'));
	Route::get('addUser',array('uses'=>'AdminController@tambahUser'));
	Route::post('addUser',array('uses'=>'AdminController@tambahUserProses'));
	Route::get('comment',array('uses'=>'AdminController@comment'));
	Route::get('setting',array('uses'=>'AdminController@setting'));
	Route::post('saveSetting',array('uses'=>'AdminController@setting'));
	Route::get('menuPick',array('uses'=>'AdminController@menuPick'));
	Route::get('module',array('uses'=>'AdminController@listModule'));
	Route::get('addModule',array('uses'=>'AdminController@addModule'));
	Route::post('addModule',array('uses'=>'AdminController@addModuleProses'));
	Route::get('logout', array( function()
	{
		Auth::logout();
		return Redirect::to('/login')
				->with('flash_notice', 'You are successfully logged out.');
	}));
});
Route::get('login',array('uses'=>'AdminController@login'));
Route::post('login',array('uses'=>'AdminController@loginProses'));

Route::get('/',array('uses'=>'HomeController@index'));
Route::get('/post/{id}',array('uses'=>'HomeController@show'));
Route::get('/listCourses',array('uses'=>'HomeController@listCourses'));
Route::get('category/{cat_item}',array('uses'=>'HomeController@category'));
Route::get('product_cat/{cat_item}',array('uses'=>'HomeController@product_category'));
Route::get('product/{cat_item}/{post}',array('uses'=>'HomeController@product'));
//Route::get('catCourses/{cat_item}',array('uses'=>'HomeController@catCourses'));
Route::get('article/{cat_item}/{post}',array('uses'=>'HomeController@article'));
Route::get('search_ajax',array('uses'=>'HomeController@search_ajax'));
Route::get('page/{page}',array('uses'=>'HomeController@page'));


Route::post('addComment',array('uses'=>'HomeController@addComment'));
Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('/')->with('flash_notice', 'You Must LOG IN First.');	
});

Route::get('feedArticle', function(){

    $feed = Feed::make();

    $feed->setCache(60, 'laravelFeedKey');
	//Cache::flush();
   
    if (!$feed->isCached())
    {
    
       $posts =  Post::with('cat_item')->where('type','post')->orderBy('created_at', 'desc')->take(20)->get();
		 $config = Config::get('blog');
     
       $feed->title =$config['blog_name'];
       $feed->description = $config['tag_line'];
       $feed->logo = $config['avatar'];
       $feed->link = URL::to('feedArticle');
       $feed->setDateFormat('datetime'); 
       $feed->pubdate = $posts[0]->created_at;
       $feed->lang = 'en';
       $feed->setShortening(true); 
       $feed->setTextLimit(100); 

       foreach ($posts as $post)
       {
          
		  
           $feed->add($post->title,$config['author'] , URL::to('article/'.$post->cat_item->slug.'/'.$post->slug), $post->created_at, $post->description,  $post->description);
       }

    }

   
    return $feed->render('atom');


});
Route::get('feedCourses', function(){

	 
  
   
    $feed = Feed::make();
	//Cache::flush();
 
    $feed->setCache(60, 'laravelFeedKey');

   
    if (!$feed->isCached())
    {
     
         $posts =  Post::with('cat_item')->where('type','courses')->orderBy('created_at', 'desc')->take(20)->get();
		 $config = Config::get('blog');
      
        $feed->title =$config['blog_name'];
       $feed->description = $config['tag_line'];
       $feed->logo = $config['avatar'];
       $feed->link = URL::to('feedCourses');
       $feed->setDateFormat('datetime'); 
       $feed->pubdate = $posts[0]->created_at;
       $feed->lang = 'en';
       $feed->setShortening(true); 
       $feed->setTextLimit(100);
       foreach ($posts as $post)
       {
         
		  
           $feed->add($post->title,$config['author'] ,  URL::to('article/'.$post->cat_item->slug.'/'.$post->slug.'?type=courses'), $post->created_at, $post->description,  $post->description);
       }

    }

    return $feed->render('atom');

   

});