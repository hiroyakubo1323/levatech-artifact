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
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('author', 100)->nullable();
            $table->string('title', 100)->nullable();
            $table->string('publisher', 50)->nullable();
            $table->string('coverImage', 200)->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('googlebook_id', 100);
            $table->integer('happy')->default(0);
            $table->integer('sadness')->default(0);
            $table->integer('anger')->default(0);
            $table->integer('surprised')->default(0);
            $table->integer('fear')->default(0);
            $table->integer('disgust')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    
       
};
