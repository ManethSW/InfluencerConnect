<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('business_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('users');
            $table->string('business_reg_no')->unique();
            $table->string('business_lisence')->unique();
            $table->string('tax_registration')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_verifications');
    }
};
