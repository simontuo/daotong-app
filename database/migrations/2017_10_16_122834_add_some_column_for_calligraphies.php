<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumnForCalligraphies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calligraphies', function (Blueprint $table) {
            $table->integer('reads_count')->default(0);
            $table->integer('comments_count')->default(0);
            $table->integer('followers_count')->default(0);
            $table->string('close_comment', 8)->default('F');
            $table->string('is_hidden', 8)->default('F');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calligraphies', function (Blueprint $table) {
            //
        });
    }
}
