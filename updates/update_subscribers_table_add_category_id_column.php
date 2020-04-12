<?php

namespace Fytinnovations\UserConnect\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateSubscribersTableAddCategoryIdColumn extends Migration
{
    public function up()
    {
        Schema::table('fytinnovations_userconnect_subscribers', function (Blueprint $table) {
            $table->integer('category_id')->after('email')->nullable()->unsigned();
            $table->foreign('category_id')->references('id')->on('fytinnovations_userconnect_categories');
        });
    }

    public function down()
    {
        Schema::table('fytinnovations_userconnect_subscribers', function (Blueprint $table) {
            $table->dropForeign('fytinnovations_userconnect_subscribers_category_id_foreign');
            $table->dropColumn('category_id');
        });
    }
}
