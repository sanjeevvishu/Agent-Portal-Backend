<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_media', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('project_id');
            $table->string('asset_type');
            $table->string('file_name');
            $table->string('file_size');
            $table->string('file_mime_type');
            $table->string('local_path')->nullable();
            $table->string('s3_path')->nullable();
            $table->string('digi_path')->nullable();
            
            $table->string('category')->nullable();
            
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
        Schema::dropIfExists('project_media');
    }
}
