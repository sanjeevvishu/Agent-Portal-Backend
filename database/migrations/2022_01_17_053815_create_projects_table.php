<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('small_description')->nullable();
            $table->text('medium_description')->nullable();
            $table->longText('long_description')->nullable();

            $table->string('logo_image')->nullable();
            $table->string('featured_image')->nullable();

            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('google_map_embed')->nullable();
            $table->text('google_map_shortlink')->nullable();


            $table->json('amenities')->default(new Expression('(JSON_ARRAY())'));
            
            $table->tinyInteger('property_stage')->default(0);
            $table->string('property_area')->nullable();
            $table->string('property_type')->nullable();
            $table->string('unit_type')->nullable();

            $table->double('min_price')->default(0);
            $table->double('max_price')->default(0);
            $table->double('min_built_up_area')->default(0);
            $table->double('max_built_up_area')->default(0);

            $table->tinyInteger('is_2d_enabled')->default(0);
            $table->tinyInteger('is_3d_enabled')->default(0);
            $table->tinyInteger('is_single_building')->default(0);
            $table->string('portal_2d_url')->nullable();

            $table->string('currency_symbol')->nullable();

            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_featured')->default(0);

            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            $table->unsignedBigInteger('created_user_id')->default(0);
            $table->unsignedBigInteger('updated_user_id')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
