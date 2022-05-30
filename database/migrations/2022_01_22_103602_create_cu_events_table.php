<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cu_events', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('category')->nullable();
            $table->string('youtube_url')->nullable();
            
            $table->string('small_description')->nullable();
            $table->text('medium_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('featured_image')->nullable();
           
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('status')->default(0);
            
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
        Schema::dropIfExists('cu_events');
    }
}
