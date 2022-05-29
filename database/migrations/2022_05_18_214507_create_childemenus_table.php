<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildemenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childemenus', function (Blueprint $table) {
            $table->id();
            $table->string('childemenu',50)->collation('utf8mb4_unicode_ci')->nullable();
            $table->bigInteger('submenu_id')->unsigned()->unique()->nullable();
            $table->foreign('submenu_id')->references('id')->on('submenus')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('childemenus');
    }
}
