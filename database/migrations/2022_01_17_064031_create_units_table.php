<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');

            $table->string('cubedots_id',75)->unique();
            $table->string('apartment_id',75)->unique();

            $table->string('status')->nullable();
            $table->string('status_id')->nullable();
            $table->string('is_reserved')->nullable();
            $table->double('price_local')->default(0);
            $table->double('price_international')->default(0);
            $table->double('built_up_area',8,2)->default(0);
            $table->string('block')->nullable();
            $table->string('floor')->nullable();
            $table->string('bedroom')->nullable();
            $table->string('checks')->nullable();

            $table->string('unit_number')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('net_area')->nullable();
            $table->string('unit_area')->nullable();
            $table->string('unit_type')->nullable();
           
            $table->string('layout')->nullable();
            $table->string('direction')->nullable();
            $table->string('balcony')->nullable();
            $table->string('terrace')->nullable();
            $table->string('private_parking')->nullable();    
            $table->string('views')->nullable();
        
            $table->tinyInteger('is_published')->default(0);

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
        Schema::dropIfExists('units');
    }
}
