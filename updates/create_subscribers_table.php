<?php namespace Fytinnovations\UserConnect\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use DB;

class CreateSubscribersTable extends Migration
{
    public function up()
    {
        Schema::create('fytinnovations_userconnect_subscribers', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('verification_key');
            $table->boolean('is_verified')->default(0);
            $table->datetime('verified_at')->nullable();
            $table->datetime('valid_till');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fytinnovations_userconnect_subscribers');
    }
}
