<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('featured_influencers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influencer_id')->constrained('users');
            $table->integer('influencer_category_id');
            $table->tinyInteger('status')->default(1)->comment('1: Active, 0: Inactive');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('featured_influencers');
    }
};
