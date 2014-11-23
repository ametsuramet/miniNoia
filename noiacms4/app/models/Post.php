<?php


class Post extends Eloquent  {

	protected $table = 'post';
	//protected $primaryKey = 'slug';
	
	public function cat_item(){
		return $this->hasOne('Cat_item' , 'id' , 'category');
	}
}
