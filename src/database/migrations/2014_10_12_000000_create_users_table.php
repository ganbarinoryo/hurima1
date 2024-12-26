<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id'); // PRIMARY KEY
            $table->string('user_name', 255)->nullable();
            $table->string('email', 255)->unique()->notNullable(); // UNIQUE and NOT NULL
            $table->string('password', 255)->notNullable(); // NOT NULL
            $table->string('postal_code', 10)->nullable(); // Postal code (nullable)
            $table->string('address', 255)->nullable(); // Address (nullable)
            $table->string('building_name', 255)->nullable(); // Building name (nullable)
            $table->timestamp('created_at')->notNullable(); // Created at (NOT NULL)
            $table->timestamp('updated_at')->nullable(); // Updated at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
