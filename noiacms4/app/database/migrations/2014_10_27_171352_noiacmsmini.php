<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Noiacmsmini extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post', function($tabel) {
			$tabel->increments('id');
			$tabel->string('title');
			$tabel->integer('type');
			$tabel->integer('category');
			$tabel->datetime('publish');
			$tabel->longtext('option');
			
			$tabel->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post');
	}

}
