<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('featured_influencers', function (Blueprint $table) {
            $table->integer('influencer_category_id');
            $table->tinyInteger('status')->default(1)->comment('1: Active, 0: Inactive');
        });
    }

    public function down(): void
    {
        Schema::table('featured_influencers', function (Blueprint $table) {
            $table->dropColumn('influencer_category_id');
            $table->dropColumn('status');
        });
    }
};
