<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsDescriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_descriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained();
            $table->char('lang',2)->default('en');
            $table->text('title');
            $table->text('short');
            $table->text('text');

            $table->index('lang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_descriptions');
    }
}
