<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('address')->nullable()->after('phone');
            $table->string('avatar')->nullable()->after('address');
            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('set null')->after('password');
            $table->foreignId('parent_id')->nullable()->constrained('users')->onDelete('cascade')->after('role_id');
            $table->boolean('is_active')->default(true)->after('parent_id');
            $table->json('permissions')->nullable()->after('is_active');
            $table->json('settings')->nullable()->after('permissions');
            $table->timestamp('last_login_at')->nullable()->after('settings');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'address', 'avatar', 'role_id', 'parent_id',
                'is_active', 'permissions', 'settings', 'last_login_at'
            ]);
        });
    }
};