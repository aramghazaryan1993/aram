<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->date('working')->nullable();
            $table->string('text_header', 250)->collation('utf8mb4_unicode_ci')->nullable();
            $table->text('text_footer')->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('facebook', 250)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('instagram', 250)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('logo_header')->nullable();
            $table->string('logo_footer')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
