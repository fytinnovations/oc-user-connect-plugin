<?php

namespace Fytinnovations\UserConnect\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use DB;
use Fytinnovations\UserConnect\Models\Category;
use Fytinnovations\UserConnect\Models\Subscriber;

class UpdateSubscribersDropColumns extends Migration
{
    public function up()
    {
        //Migrate data to new tables before deleting columns
        $subscribers = Subscriber::all();

        $defaultCategory = Category::first();

        foreach ($subscribers as $key => $subscriber) {
            $subscriber->subscriptions()->add($defaultCategory, [
                'verification_key' => $subscriber->verification_key,
                'is_verified' => $subscriber->is_verified,
                'valid_till' => $subscriber->valid_till,
            ]);
        }

        Schema::table('fytinnovations_userconnect_subscribers', function (Blueprint $table) {
            $table->dropColumn('verification_key');
            $table->dropColumn('is_verified');
            $table->dropColumn('verified_at');
            $table->dropColumn('valid_till');
        });
    }

    public function down()
    {
        Schema::table('fytinnovations_userconnect_subscribers', function (Blueprint $table) {
            $table->string('verification_key');
            $table->boolean('is_verified')->default(0);
            $table->datetime('verified_at')->nullable();
            $table->datetime('valid_till');
        });
    }
}
