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
        Schema::create('seo_listes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->json('property_prefix_codes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('seo_listes_translates', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->default('fr');
            $table->string('meta_title_seo');
            $table->text('meta_description_seo');
            $table->text('header_h1');
            $table->text('intro');
            $table->text('content');
            $table->foreignId('seo_liste_id')->constrained('seo_listes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seo_listes_translates', function (Blueprint $table){
            $table->dropForeign('seo_listes_translates_seo_liste_id_foreign');
        });

        Schema::dropIfExists('seo_listes_translates');
        Schema::dropIfExists('seo_listes');
    }
};
