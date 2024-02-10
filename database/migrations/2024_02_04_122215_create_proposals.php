<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collaboration_id')->constrained('collaborations');
            $table->foreignId('influencer_id')->constrained('users');
            $table->decimal('proposed_budget', 8, 2);
            $table->text('supporting_links')->nullable();
            $table->string('supporting_files')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
