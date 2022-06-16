<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('title',50)->collation('utf8mb4_unicode_ci')->nullable();
            $table->text('mini_text')->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('image',50)->collation('utf8mb4_unicode_ci')->nullable();
            $table->text('text')->collation('utf8mb4_unicode_ci')->nullable();
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
        Schema::dropIfExists('about_us');
    }
}
