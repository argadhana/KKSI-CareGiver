<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEsccortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('esccorts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('salary');
            $table->text('keahlian');
            $table->string('name');
            $table->string('age');
            $table->string('address');
            $table->string('gender');
            $table->string('phone');
            $table->string('photo');
            $table->float('rating');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('esccorts');
    }
}
