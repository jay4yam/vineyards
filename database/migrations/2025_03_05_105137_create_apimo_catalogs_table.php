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
        foreach ( config('catalogs') as $key => $value )
        {
            Schema::create('catalog_'.$key, function(Blueprint $table){
                $table->unsignedBigInteger('id')->index();
                $table->string('locale');
                $table->text('name');
                $table->text('name_plurial')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        foreach ( config('catalogs') as $key => $value ) {
            Schema::dropIfExists("catalog_".$key);
        }
        */
    }
};
