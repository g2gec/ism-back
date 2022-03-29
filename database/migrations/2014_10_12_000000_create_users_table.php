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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('name');
            $table->string('apellido');
            $table->integer('membresia_id')->nullable();
            $table->longText('membresia_numero')->nullable();
            $table->string('costo_membresia')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('token_confirmation')->nullable();
            $table->string('documento')->nullable();
            $table->date('fecha_expiracion_documento')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('canHire')->nullable();
            $table->string('country')->nullable();
            $table->boolean('isPublic')->nullable();
            $table->string('phone')->nullable();
            $table->string('username')->nullable();
            $table->boolean('isActive')->nullable();
            $table->dateTime('lastActivity')->nullable();
            $table->string('descuento')->nullable();
            $table->enum('role', ['admin', 'asociado', 'vendedor']);
            $table->string('state')->nullable();
            $table->enum('tier', ['ADMINISTRADOR', 'ASOCIADO', 'VENDEDOR']);
            $table->enum('tipo_vendedor', ['INTERNO', 'EXTERNO'])->nullable();
            $table->string('domicilio')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
