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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('category')->default('Laravel')->nullable()->after('technology');
            $table->string('client')->nullable()->after('category');
            $table->string('duration')->nullable()->after('client');
            $table->text('problem')->nullable()->after('description');
            $table->text('solution')->nullable()->after('problem');
            $table->text('results')->nullable()->after('solution');
            $table->longText('use_case')->nullable()->after('results');
            $table->text('features')->nullable()->after('use_case');
            $table->string('github_url')->nullable()->after('url');
            $table->boolean('is_featured')->default(false)->after('is_published');
            $table->integer('order')->default(0)->after('is_featured');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->string('category')->default('Laravel')->after('title');
            $table->string('tags')->nullable()->after('category');
            $table->text('summary')->nullable()->after('tags');
            $table->string('youtube_video_id')->nullable()->after('image');
            $table->string('author_name')->default('Md Rabbi Hasan')->after('youtube_video_id');
            $table->string('reading_time')->default('5 min read')->after('author_name');
            $table->integer('views_count')->default(0)->after('reading_time');
            $table->boolean('is_featured')->default(false)->after('is_published');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'category', 'client', 'duration', 'problem', 'solution',
                'results', 'use_case', 'features', 'github_url', 'is_featured', 'order',
            ]);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'category', 'tags', 'summary', 'youtube_video_id',
                'author_name', 'reading_time', 'views_count', 'is_featured',
            ]);
        });
    }
};
