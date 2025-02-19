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
        Schema::create('user_role', function (Blueprint $table) {
            $table->integer('user_id')->comment('用户id');
            $table->integer('role_id')->comment('角色id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();

            $table->unique(['user_id', 'role_id'], 'user_role');

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
        Schema::dropIfExists('user_role');
    }
};
