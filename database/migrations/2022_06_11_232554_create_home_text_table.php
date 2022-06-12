<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_text', function (Blueprint $table) {
            $table->id();
            $table->string('title_one',100)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('title_two',100)->collation('utf8mb4_unicode_ci')->nullable();
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
        Schema::dropIfExists('home_text');
    }
}
