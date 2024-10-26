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
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['blog_post_id']);
            $table->dropColumn('blog_post_id');

            $table->morphs('commentable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            // $table->dropMorphs('commentable');

            // $table->foreign('blog_post_id')->references('id')->on('blog_posts');
            // $table->unsignedInteger('blog_post_id')->index()->nullable();

            //$table->dropMorphs('commentable');


            if (Schema::hasTable('comments')) {
                $sm = Schema::getConnection()->getDoctrineSchemaManager();
                $indexes = $sm->listTableIndexes('comments');

                if (array_key_exists('comments_commentable_type_commentable_id_index', $indexes)) {
                    $table->dropIndex(['commentable_type', 'commentable_id']);
                }
            }


            // إعادة إضافة عمود blog_post_id والقيد الأجنبي
            
            $table->foreign('blog_post_id')->references('id')->on('blog_posts')->onDelete('cascade');
            $table->unsignedBigInteger('blog_post_id')->index();
            
        
        });
    }
};
