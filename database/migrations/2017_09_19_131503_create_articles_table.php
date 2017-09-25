<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cover')->nullable(); // 封面图
            $table->string('title'); // 标题
            $table->text('bio'); // 内容
            $table->integer('user_id')->unsigned(); // 创建者id
            $table->integer('comments_count')->default(0); // 评论数量
            $table->integer('followers_count')->default(0); // 关注数量
            $table->integer('reflections_count')->default(0); // 感想数量
            $table->string('close_comment', 8)->default('F'); // 关闭评论
            $table->string('close_reflection', 8)->default('F'); // 关闭感想
            $table->string('is_hidden', 8)->default('F'); // 是否隐藏
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
        Schema::dropIfExists('articles');
    }
}
