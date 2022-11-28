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
        Schema::create('emotion_recommendation', function (Blueprint $table) {
            $table->foreignID('emotion_id')->constrained('emotions');
            $table->foreignID('recommendation_id')->constrained('recommendations');
            $table->primary(['emotion_id', 'recommendation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
};
