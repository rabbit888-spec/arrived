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
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->unique()->comment('角色名称');
            $table->text('permission_ids')->nullable()->comment('角色权限');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();

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
        Schema::dropIfExists('roles');
    }
};
