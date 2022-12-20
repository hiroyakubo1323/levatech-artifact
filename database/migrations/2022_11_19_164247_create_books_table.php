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
            $table->string('author', 100);
            $table->string('title', 100);
            $table->string('publisher', 50);
            $table->string('coverImage', 200);
            $table->string('description', 1000);
            $table->integer('googlebook_id');
            $table->integer('happy');
            $table->integer('sadness');
            $table->integer('anger');
            $table->integer('surprised');
            $table->integer('fear');
            $table->integer('disgust');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    
       
};
