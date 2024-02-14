<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('collaboration_tasks', function (Blueprint $table) {
            $table->text('supporting_links')->nullable();
            $table->string('supporting_file_1')->nullable();
            $table->string('supporting_file_2')->nullable();
            $table->string('supporting_file_3')->nullable();
            $table->string('supporting_file_4')->nullable();
            $table->string('supporting_file_5')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('collaboration_tasks', function (Blueprint $table) {
            $table->dropColumn('supporting_links');
            $table->dropColumn('supporting_file_1');
            $table->dropColumn('supporting_file_2');
            $table->dropColumn('supporting_file_3');
            $table->dropColumn('supporting_file_4');
            $table->dropColumn('supporting_file_5');
        });
    }
};
