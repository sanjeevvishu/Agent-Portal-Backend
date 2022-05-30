<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuVersesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cu_verses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('cu_verse_category_id');
            $table->string('language');

            $table->string('title')->nullable();
            $table->string('caption')->nullable();

            $table->string('file_name');
            $table->string('file_size');
            $table->string('file_mime_type');
            $table->string('file_s3_path')->nullable();
          
            $table->string('visibility',45);

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
        Schema::dropIfExists('cu_verses');
    }
}
