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
        Schema::create('recommendation_recruite', function (Blueprint $table) {
            $table->foreignID('recommendation_id')->constrained('recommendations');
            $table->foreignID('recruite_id')->constrained('recruites');
            $table->primary(['recommendation_id', 'recruite_id']);   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
};
