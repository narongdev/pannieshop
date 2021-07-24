<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatagoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catagories', function (Blueprint $table) {
            $table->id();
            $table->increments('id');
            $table->string('catagory');
            $table->boolean('recommend');
            $table->integer('clicks');
            $table->float('amount', 8, 2);
            $table->enum('status', ['enable', 'disable']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catagories');
    }
}
