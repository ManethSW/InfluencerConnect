<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('influencer_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('avatar');
            $table->foreignId('influencer_category_id')->constrained();
            $table->smallInteger('rating');
            $table->timestamp('description');
            $table->boolean('visible');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('influencer_cards');
    }
};
