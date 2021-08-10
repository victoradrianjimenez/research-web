<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained();
            $table->char('lang',2)->default('en');
            $table->enum('type', ['section','subsection']);
            $table->string('title');
            $table->string('logo')->nullable();
            $table->string('link')->nullable();
            $table->text('text')->nullable();

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
        Schema::dropIfExists('description');
    }
}
