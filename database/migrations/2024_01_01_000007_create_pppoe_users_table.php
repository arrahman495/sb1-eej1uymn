<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pppoe_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Reseller/Sub-reseller
            $table->foreignId('pop_id')->constrained('pops')->onDelete('cascade');
            $table->foreignId('sdt_zone_id')->constrained('sdt_zones')->onDelete('cascade');
            $table->foreignId('mikrotik_router_id')->constrained('mikrotik_routers')->onDelete('cascade');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->text('customer_address')->nullable();
            $table->string('service_type')->default('pppoe');
            $table->string('profile_name')->nullable();
            $table->string('ip_address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_online')->default(false);
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('last_logout_at')->nullable();
            $table->bigInteger('bytes_in')->default(0);
            $table->bigInteger('bytes_out')->default(0);
            $table->json('mikrotik_data')->nullable();
            $table->json('settings')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'is_active']);
            $table->index(['pop_id', 'sdt_zone_id']);
            $table->index(['is_active', 'is_online']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pppoe_users');
    }
};