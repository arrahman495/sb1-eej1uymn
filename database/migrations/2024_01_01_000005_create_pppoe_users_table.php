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
        Schema::create('pppoe_users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('profile')->nullable();
            $table->string('service')->nullable();
            $table->string('local_address')->nullable();
            $table->string('remote_address')->nullable();
            $table->string('status')->nullable();
            $table->timestamp('last_logged_out')->nullable();
            $table->string('uptime')->nullable();
            $table->bigInteger('bytes_in')->default(0);
            $table->bigInteger('bytes_out')->default(0);
            $table->bigInteger('packets_in')->default(0);
            $table->bigInteger('packets_out')->default(0);
            $table->unsignedBigInteger('mikrotik_router_id');
            $table->unsignedBigInteger('isp_owner_id');
            $table->unsignedBigInteger('reseller_id')->nullable();
            $table->unsignedBigInteger('sub_reseller_id')->nullable();
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->text('customer_address')->nullable();
            $table->enum('billing_cycle', ['monthly', 'quarterly', 'yearly'])->default('monthly');
            $table->decimal('monthly_fee', 10, 2);
            $table->date('installation_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('mikrotik_router_id')->references('id')->on('mikrotik_routers')->onDelete('cascade');
            $table->foreign('isp_owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reseller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sub_reseller_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->index(['isp_owner_id', 'is_active']);
            $table->index(['reseller_id', 'is_active']);
            $table->index(['status', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pppoe_users');
    }
};