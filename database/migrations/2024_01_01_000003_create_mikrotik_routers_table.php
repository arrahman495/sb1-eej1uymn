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
        Schema::create('mikrotik_routers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ip_address');
            $table->integer('port')->default(22);
            $table->string('username');
            $table->string('password');
            $table->integer('api_port')->default(8728);
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_connected_at')->nullable();
            $table->enum('connection_status', ['connected', 'disconnected', 'error'])->default('disconnected');
            $table->string('version')->nullable();
            $table->string('model')->nullable();
            $table->unsignedBigInteger('isp_owner_id');
            $table->string('location')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('isp_owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['ip_address', 'port', 'isp_owner_id']);
            $table->index(['isp_owner_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mikrotik_routers');
    }
};