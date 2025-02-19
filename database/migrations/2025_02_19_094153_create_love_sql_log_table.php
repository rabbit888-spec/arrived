<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sql_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户 ID');
            $table->text('sql')->comment('SQL 语句');
            $table->text('error')->nullable()->comment('错误信息');
            $table->timestamp('created_at')->useCurrent();

            $table->engine = 'MyISAM';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sql_log');
    }
};
