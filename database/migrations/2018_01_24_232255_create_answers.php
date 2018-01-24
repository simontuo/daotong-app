<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->text('bio');
            $table->text('markdown_bio');
            $table->integer('votes_count')->default(0);
            $table->integer('comments_count')->default(0);
            $table->string('is_hidden', 8)->default('F');
            $table->string('close_comment', 8)->default('F');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
