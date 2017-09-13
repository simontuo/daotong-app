<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomethingToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar'); //头像
            $table->string('confirmation_token'); //注册认证token
            $table->smallInteger('is_active')->default(0); //激活
            $table->integer('articles_count')->default(0); //文章数量
            $table->integer('pomes_count')->default(0); //诗歌数量
            $table->integer('questions_count')->default(0); //提问数量
            $table->integer('impressions_count')->default(0); //读后感数量
            $table->integer('answers_count')->default(0); //回答数量
            $table->integer('comments_count')->default(0); //评论数量
            $table->integer('favourites_count')->default(0); //收藏数量
            $table->integer('likes_count')->default(0); //点赞数量
            $table->integer('followers_count')->default(0); //关注数量
            $table->integer('be_follows_count')->default(0); //被关注数量
            $table->text('settings')->nullable(); //设置
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
