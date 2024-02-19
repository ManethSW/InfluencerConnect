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
            $table->text('supporting_links')->nullable();
            $table->string('supporting_file_1')->nullable();
            $table->string('supporting_file_2')->nullable();
            $table->string('supporting_file_3')->nullable();
            $table->string('supporting_file_4')->nullable();
            $table->string('supporting_file_5')->nullable();
            $table->tinyInteger('priority');
//            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collaboration_tasks');
    }
};
