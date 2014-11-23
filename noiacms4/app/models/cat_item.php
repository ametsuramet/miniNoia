<?php


class Cat_item extends Eloquent  {

	protected $table = 'cat_item';

	public function post(){
	return	$this->belogsTo('Post' , 'category' , 'id');
	}

}
