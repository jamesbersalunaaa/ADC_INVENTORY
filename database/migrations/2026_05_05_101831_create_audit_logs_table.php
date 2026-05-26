<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
    $table->id();
    $table->string('module')->nullable();
    $table->string('action')->nullable();
    $table->text('description')->nullable();
    $table->text('old_value')->nullable();
    $table->text('new_value')->nullable();
    $table->unsignedBigInteger('user_id')->nullable();
    $table->string('user_name')->nullable();
    $table->string('ip_address')->nullable();
    $table->text('device')->nullable();
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};