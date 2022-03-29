<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_customers', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_type')->nullable();
            $table->unsignedBigInteger('membership_id')->nullable();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->string('membership_number')->nullable();
            $table->string('document')->nullable();
            $table->string('duration')->nullable();
            $table->string('cost')->nullable();
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('type_accommodation')->nullable();
            $table->string('accommodation_name')->nullable();
            $table->string('accommodation_address')->nullable();
            $table->string('filename')->nullable();
            $table->integer('status');
            $table->timestamps();

            //$table->foreign('membership_id')->references('id')->on('memberships')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_customers');
    }
}
