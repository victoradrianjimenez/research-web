<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['project','development']);
            $table->string('title');
            $table->string('logo');
            $table->string('institution')->nullable();
            $table->string('code')->nullable();
            $table->string('period');
            $table->string('class');
            $table->string('url');
            $table->string('link')->nullable();
            $table->string('participants');
            $table->timestamps();

            $table->unique('url');
            $table->index('period');
            $table->index('class');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project');
    }
}
