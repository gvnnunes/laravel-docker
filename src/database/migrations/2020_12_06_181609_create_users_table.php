<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable.
 */
class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
			
			//people data
			$table->string('name', 100);			
			$table->char('cpf', 11)->unique();			
			$table->char('phone', 11)->nullable();
			$table->date('birth')->nullable();
			
			//auth data
			$table->string('email', 100)->unique();
			$table->string('password', 255);
			
			//permission
			$table->string('status')->default('active');
			$table->string('permission')->default('app.user');

			$table->rememberToken();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::create('users', function(Blueprint $table) {

		});
		
		Schema::drop('users');
	}
}
