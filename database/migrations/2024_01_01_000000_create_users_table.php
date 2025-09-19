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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->unsignedBigInteger('isp_owner_id')->nullable();
            $table->unsignedBigInteger('reseller_id')->nullable();
            $table->unsignedBigInteger('sub_reseller_id')->nullable();
            $table->decimal('commission_rate', 5, 2)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('isp_owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reseller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sub_reseller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            
            $table->index(['status', 'isp_owner_id']);
            $table->index(['reseller_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};