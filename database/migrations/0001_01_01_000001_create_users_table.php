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
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('agency_id')->nullable()->constrained('agencies');
            $table->boolean('is_active')->default(false);
            $table->string('firstname');
            $table->string('slug_firstname');
            $table->string('lastname');
            $table->string('slug_lastname');
            $table->string('username');
            $table->string('job_title')->default('Property Broker');
            $table->string('company_name')->nullable()->default('Michaël Zingraf Vineyards');
            $table->string('email')->unique();
            $table->enum('role', ['admin', 'broker', 'guest', 'partner', 'user'])->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable()->default('https://www.michaelzingraf.com');
            $table->string('linkedin_profile_url')->nullable()->default('https://www.linkedin.com/company/michael-zingraf-immobilier');
            $table->string('facebook_profile_url')->nullable()->default('https://www.facebook.com/MichaelZingraf');
            $table->string('youtube_profile_url')->nullable()->default('https://www.youtube.com/@michaelzingrafrealestate8196');
            $table->string('instagram_profile_url')->nullable()->default('https://www.instagram.com/michaelzingrafrealestate/');
            $table->string('avatar')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('biography_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('locale')->nullable()->default('fr');
            $table->text('content')->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_agency_id_foreign');
        });

        Schema::table('biography_translations', function (Blueprint $table){
            $table->dropForeign('biography_user_id_foreign');
        });

        Schema::dropIfExists('biography_translations');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
