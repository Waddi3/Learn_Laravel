<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('blog-post-id');

            // $table->unsignedBigInteger('imageable_id');
            // $table->string('imageable_type');

            $table->morphs('imageable');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('images', function (Blueprint $table) {
             $table->unsignedBigInteger('blog-post-id')->nullable();
             $table->dropMorphs('imageable');
         });
       // Schema::dropIfExists('images');
    }
};
