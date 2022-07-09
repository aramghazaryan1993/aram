<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adress', function (Blueprint $table) {
            $table->id();
            $table->string('map',200)->collation('utf8mb4_unicode_ci')->nullable();
            $table->text('text')->collation('utf8mb4_unicode_ci')->nullable();
            $table->unsignedBigInteger('adress_menu_id');
            $table->foreign('adress_menu_id')->references('id')->on('adress_menus')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('adress');
    }
}
