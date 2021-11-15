<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAirlineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airlines', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('country');
            $table->longText('logo')->nullable(true);
            $table->string('slogan')->nullable(true);
            $table->text('headquarters');  // cave in api head_quaters !
            $table->text('website');
            $table->text('established');
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
        Schema::dropIfExists('airline_table');

    }
}
