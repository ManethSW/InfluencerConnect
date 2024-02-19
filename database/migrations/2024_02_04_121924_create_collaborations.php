<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('collaborations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('users');
            $table->foreignId('influencer_id')->nullable()->constrained('users');
            $table->tinyInteger('request_type');
            $table->string('title');
            $table->tinyInteger('collaboration_type');
            $table->text('description');
            $table->decimal('budget', 8, 2);
            $table->date('deadline');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collaborations');
    }
};
