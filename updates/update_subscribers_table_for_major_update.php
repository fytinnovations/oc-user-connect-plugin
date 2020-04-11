<?php

namespace Fytinnovations\UserConnect\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateSubscribersTableForMajorUpdate extends Migration
{
    public function up()
    {
        Schema::table('fytinnovations_userconnect_subscribers', function (Blueprint $table) {
            $table->string('verification_key')->nullable()->change();
            $table->datetime('valid_till')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('fytinnovations_userconnect_subscribers', function (Blueprint $table) {
            $table->string('verification_key')->change();
            $table->datetime('valid_till')->change();
        });
    }
}
