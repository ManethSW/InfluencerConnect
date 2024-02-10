<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('collaboration_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collaboration_id')->constrained('collaborations');
            $table->text('description');
            $table->tinyInteger('priority');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collaboration_tasks');
    }
};
