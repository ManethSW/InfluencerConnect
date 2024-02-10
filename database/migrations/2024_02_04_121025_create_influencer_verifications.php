<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('influencer_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influencer_id')->constrained('users');
            $table->string('NIC')->unique()->nullable();
            $table->string('Driving License')->unique()->nullable();
            $table->string('Passport')->unique()->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('influencer_verifications');
    }
};
