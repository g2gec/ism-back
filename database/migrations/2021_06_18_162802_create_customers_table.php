<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_type');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('country');
            $table->string('city');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('type_accommodation')->nullable();
            $table->string('accommodation_name')->nullable();
            $table->string('accommodation_address')->nullable();
            $table->string('filename')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
