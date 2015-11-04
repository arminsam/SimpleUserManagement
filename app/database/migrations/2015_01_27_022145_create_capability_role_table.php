<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapabilityRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('capability_role', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('capability_id')->unsigned();
			$table->foreign('capability_id')->references('id')->on('capabilities');
			$table->integer('role_id')->unsigned();
			$table->foreign('role_id')->references('id')->on('roles');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('capability_role');
	}

}
