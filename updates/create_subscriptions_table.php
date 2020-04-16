<?php

namespace Fytinnovations\Userconnect\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('fytinnovations_userconnect_subscriptions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('subscriber_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('verification_key')->nullable()->change();
            $table->boolean('is_verified')->default(0);
            $table->datetime('verified_at')->nullable();
            $table->datetime('valid_till')->nullable()->change();
            $table->timestamps();
        });

        Schema::table('fytinnovations_userconnect_subscriptions', function (Blueprint $table) {
            $table->foreign('subscriber_id')->references('id')->on('fytinnovations_userconnect_subscribers');
            $table->foreign('category_id')->references('id')->on('fytinnovations_userconnect_categories');
        });
    }

    public function down()
    {
        Schema::table('fytinnovations_userconnect_subscriptions', function (Blueprint $table) {
            $table->dropForeign('fytinnovations_userconnect_subscriptions_subscriber_id_foreign');
            $table->dropForeign('fytinnovations_userconnect_subscriptions_category_id_foreign');
        });
        Schema::dropIfExists('fytinnovations_userconnect_subscriptions');
    }
}
