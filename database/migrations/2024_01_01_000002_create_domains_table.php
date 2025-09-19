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
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('domain_name');
            $table->string('txt_record_key')->nullable();
            $table->string('txt_record_value')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->unsignedBigInteger('isp_owner_id');
            $table->text('ssl_certificate')->nullable();
            $table->timestamp('ssl_expiry_date')->nullable();
            $table->timestamps();

            $table->foreign('isp_owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['domain_name', 'isp_owner_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};