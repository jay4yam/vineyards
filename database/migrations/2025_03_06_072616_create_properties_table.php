<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('reference');
            $table->foreignId('agency_id')->constrained('agencies')->cascadeOnDelete();
            $table->string('sector')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('step_id')->constrained('catalog_property_step');
            $table->foreignId('status_id')->constrained('catalog_property_status');
            $table->foreignId('parent_id')->nullable()->constrained('properties')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('catalog_property_category');
            $table->foreignId('subcategory_id')->nullable()->constrained('catalog_property_subcategory');
            $table->string('name')->nullable();
            $table->foreignId('type_id')->nullable()->constrained('catalog_property_type');
            $table->foreignId('subtype_id')->nullable()->constrained('catalog_property_subtype');
            $table->foreignId('agreement_id')->nullable()->constrained('catalog_property_agreement');
            $table->string('block_name')->nullable();
            $table->string('lot_reference')->nullable();
            $table->string('cadastre_reference')->nullable();
            $table->string('address')->nullable();
            $table->string('address_more')->nullable();
            $table->boolean('is_published_address')->default(false);
            $table->string('country');
            $table->foreignId('region_id')->nullable()->constrained('regions')->cascadeOnDelete();
            $table->foreignId( 'city_id')->nullable()->constrained('cities')->cascadeOnDelete();
            $table->foreignId('district_id')->nullable()->constrained('districts')->cascadeOnDelete();
            $table->float('longitude')->nullable();
            $table->float('latitude')->nullable();
            $table->integer('radius')->nullable();
            $table->integer('altitude')->nullable();
            $table->foreignId('area_id')->constrained('catalog_unit_area');
            $table->float('area_value')->nullable();
            $table->float('area_total')->nullable();
            $table->float('area_weighted')->nullable();
            $table->float('plot_net_floor')->nullable();
            $table->float('plot_floor_area')->nullable();
            $table->integer('rooms')->default(0);
            $table->integer('bedrooms')->default(0);
            $table->integer('sleeps')->default(0);
            $table->integer('price')->default(0);
            $table->string('currency')->nullable();
            $table->foreignId('view_type_id')->nullable()->constrained('catalog_property_view_type');
            $table->json('landscape')->nullable();
            $table->foreignId('construction_method_id')->nullable()->constrained('catalog_property_construction_method');
            $table->string('construction_year')->nullable();
            $table->foreignId('construction_step_id')->nullable()->constrained('catalog_construction_step');
            $table->foreignId('floor_id')->nullable()->constrained('catalog_property_floor');
            $table->string('floor_value')->default(0);
            $table->string('floor_level')->nullable();
            $table->string('floor_total')->nullable();
            $table->foreignId('heating_device_id')->nullable()->constrained('catalog_property_heating_device');
            $table->foreignId('heating_access_id')->nullable()->constrained('catalog_property_heating_access');
            $table->foreignId('heating_type_id')->nullable()->constrained('catalog_property_heating_type');
            $table->foreignId('water_hot_device_id')->nullable()->constrained('catalog_property_hot_water_device');
            $table->foreignId('hot_water_access_id')->nullable()->constrained('catalog_property_hot_water_access');
            $table->foreignId('waste_water_id')->nullable()->constrained('catalog_property_waste_water');
            $table->foreignId( 'condition_id')->nullable()->constrained('catalog_property_condition');
            $table->foreignId('standing_id')->nullable()->constrained('catalog_property_standing');
            $table->string('style')->nullable();
            $table->string('facade')->nullable();
            $table->foreignId('availability_id')->nullable()->constrained('catalog_property_availability');
            $table->date('available_at')->nullable();
            $table->date('delivered_at')->nullable();
            $table->json('activities')->nullable();
            $table->json('orientations')->nullable();
            $table->json('services')->nullable();
            $table->json('proximities')->nullable();
            $table->timestamps();
        });

        Schema::create('tags_customized', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('locale');
            $table->string('label');
            $table->string('value')->unique()->nullable();
        });

        Schema::create('property_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties')->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained('tags_customized')->cascadeOnDelete();
        });

        Schema::create('pictures', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->integer('rank');
            $table->string('url');
            $table->string('name');
            $table->integer('width_max')->nullable();
            $table->integer('height_max')->nullable();
            $table->boolean('internet')->default(true);
            $table->boolean('printer')->default(false);
            $table->boolean('child')->default(false);
            $table->string('reference')->nullable();
            $table->foreignId('property_id')->constrained('properties')->cascadeOnDelete();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('hook')->nullable();
            $table->text('comment');
            $table->text('comment_full')->nullable();
            $table->foreignId('property_id')->constrained('properties')->cascadeOnDelete();
        });

        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_area_id')->constrained('catalog_property_areas')->cascadeOnDelete();
            $table->integer('number')->nullable();
            $table->string('area')->nullable();
            $table->foreignId('property_flooring_id')->nullable()->constrained('catalog_property_flooring')->cascadeOnDelete();
            $table->json('floor')->nullable();
            $table->json('orientations')->nullable();
            $table->json('comments')->nullable();
            $table->foreignId('property_id')->constrained('properties')->cascadeOnDelete();
        });

        Schema::create('regulations', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('property_regulation_id')->constrained('catalog_property_regulation')->cascadeOnDelete();
            $table->string('value')->nullable();
            $table->date('date')->nullable();
            $table->string('label')->nullable();
            $table->string('image')->nullable();
            $table->longText('graph')->nullable()->charset('binary');
            $table->foreignId('property_id')->constrained('properties')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_tag', function (Blueprint $table){
            $table->dropForeign('property_tag_tag_id_foreign');
            $table->dropForeign('property_tag_property_id_foreign');
        });

        Schema::table('pictures', function (Blueprint $table){
            $table->dropForeign('pictures_property_id_foreign');
        });

        Schema::table('comments', function (Blueprint $table){
            $table->dropForeign('comments_property_id_foreign');
        });

        Schema::table('areas', function (Blueprint $table){
            $table->dropForeign('areas_property_area_id_foreign');
            $table->dropForeign('areas_property_flooring_id_foreign');
            $table->dropForeign('areas_property_id_foreign');
        });

        Schema::table('regulations', function (Blueprint $table){
            $table->dropForeign('regulations_property_regulation_id_foreign');
        });

        Schema::dropIfExists('tags_customized');
        Schema::dropIfExists('property_tag');
        Schema::dropIfExists('pictures');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('areas');
        Schema::dropIfExists('regulations');
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign('properties_agency_id_foreign');
            $table->dropForeign('properties_user_id_foreign');
            $table->dropForeign('properties_step_id_foreign');
            $table->dropForeign('properties_status_id_foreign');
            $table->dropForeign('properties_parent_id_foreign');
            $table->dropForeign('properties_category_id_foreign');
            $table->dropForeign('properties_subcategory_id_foreign');
            $table->dropForeign('properties_type_id_foreign');
            $table->dropForeign('properties_agreement_id_foreign');
            $table->dropForeign('properties_region_id_foreign');
            $table->dropForeign('properties_city_id_foreign');
            $table->dropForeign('properties_district_id_foreign');
            $table->dropForeign('properties_area_id_foreign');
            $table->dropForeign('properties_view_type_id_foreign');
            $table->dropForeign('properties_construction_method_id_foreign');
            $table->dropForeign('properties_construction_step_id_foreign');
            $table->dropForeign('properties_floor_id_foreign');
            $table->dropForeign('properties_heating_device_id_foreign');
            $table->dropForeign('properties_heating_access_id_foreign');
            $table->dropForeign('properties_heating_type_id_foreign');
            $table->dropForeign('properties_water_hot_device_id_foreign');
            $table->dropForeign('properties_hot_water_access_id_foreign');
            $table->dropForeign('properties_waste_water_id_foreign');
            $table->dropForeign('properties_condition_id_foreign');
            $table->dropForeign('properties_standing_id_foreign');
            $table->dropForeign('properties_availability_id_foreign');
        });
        Schema::dropIfExists('properties');
    }
};
