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
        Schema::create('cities', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('name');
            $table->string('zipcode');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('regions', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('name');
            $table->string('slug');
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('name');
            $table->string('slug');
        });

        Schema::create('agencies', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->boolean('is_christies')->default(true);
            $table->boolean('is_active');
            $table->string('name');
            $table->string('address');
            $table->string('postal');
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->string('country');
            $table->string('region');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('email');
            $table->string('phone');
            $table->string('fax')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_svg')->nullable();
            $table->string('picture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agencies', function (Blueprint $table){
            $table->dropForeign('agencies_city_id_foreign');
        });

        Schema::dropIfExists('agencies');

        Schema::dropIfExists('cities');

        Schema::dropIfExists('regions');

        Schema::dropIfExists('districts');
    }
};
