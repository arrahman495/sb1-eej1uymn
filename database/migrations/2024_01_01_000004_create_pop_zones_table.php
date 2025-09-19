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
        Schema::create('pop_zones', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('mikrotik_router_id');
            $table->unsignedBigInteger('isp_owner_id');
            $table->unsignedBigInteger('reseller_id')->nullable();
            $table->unsignedBigInteger('sub_reseller_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('coordinates')->nullable();
            $table->json('coverage_area')->nullable();
            $table->timestamps();

            $table->foreign('mikrotik_router_id')->references('id')->on('mikrotik_routers')->onDelete('cascade');
            $table->foreign('isp_owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reseller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sub_reseller_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->index(['isp_owner_id', 'is_active']);
            $table->index(['reseller_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pop_zones');
    }
};