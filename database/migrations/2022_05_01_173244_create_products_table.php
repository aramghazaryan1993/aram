<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title',50)->collation('utf8mb4_unicode_ci')->nullable();
            $table->text('text')->collation('utf8mb4_unicode_ci')->nullable();
            $table->text('image')->nullable();
            $table->string('header_title',250)->collation('utf8mb4_unicode_ci')->nullable();
            $table->date('header_working')->nullable();
            $table->string('header_image',250)->nullable();
            $table->string('header_phone',250)->collation('utf8mb4_unicode_ci')->nullable();
            $table->bigInteger('menu_id')->unsigned()->unique();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('products');
    }
}
