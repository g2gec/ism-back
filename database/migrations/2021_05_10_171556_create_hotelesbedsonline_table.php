<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelesbedsonlineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotelesbedsonline', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('code')->nullable();
            $table->longText('name')->nullable();
            $table->longText('description')->nullable();
            $table->longText('countryCode')->nullable();
            $table->longText('estateCode')->nullable();
            $table->longText('destinationCode')->nullable();
            $table->longText('zoneCode')->nullable();
            $table->longText('coordinates')->nullable();
            $table->longText('categoryCode')->nullable();
            $table->longText('categoryGroupCode')->nullable();
            $table->longText('chaincode')->nullable();
            $table->longText('accommodationTypeCode')->nullable();
            $table->longText('segmentCodes')->nullable();
            $table->longText('address')->nullable();
            $table->longText('postalCode')->nullable();
            $table->longText('city')->nullable();
            $table->longText('email')->nullable();
            $table->longText('license')->nullable();
            $table->longText('phones')->nullable();
            $table->longText('rooms')->nullable();
            $table->longText('facilities')->nullable();
            $table->longText('terminals')->nullable();
            $table->longText('issues')->nullable();
            $table->longText('images')->nullable();
            $table->longText('wildcards')->nullable();
            $table->longText('web')->nullable();
            $table->longText('lastupdate')->nullable();
            $table->longText('S2C')->nullable();
            $table->longText('ranking')->nullable();
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
        Schema::dropIfExists('hotelesbedsonline');
    }
}
