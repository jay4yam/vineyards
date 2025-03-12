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
            $table->string('email')->unique();
            $table->enum('role', ['admin', 'broker', 'guest', 'partner', 'user'])->nullable();
            $table->string('mobile');
            $table->string('phone');
            $table->string('linkedin_profile_url')->default('https://www.linkedin.com/company/michael-zingraf-immobilier');
            $table->string('facebook_profile_url')->default('https://www.facebook.com/MichaelZingraf');
            $table->string('youtube_profile_url')->default('https://www.youtube.com/@michaelzingrafrealestate8196');
            $table->string('instagram_profile_url')->default('https://www.instagram.com/michaelzingrafrealestate/');
            $table->string('avatar')->nullable();
            $table->text('biography')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
