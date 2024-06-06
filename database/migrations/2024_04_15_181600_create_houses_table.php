<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('NomberRoom');
            $table->string('DistanceFac');
            $table->string('HouseGender');
            $table->string('adresse');
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('landlord_id'); 
            $table->foreign('landlord_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Suppression de la contrainte
        Schema::table('houses', function (Blueprint $table) {
            $table->dropForeign(['landlord_id']);
        });
    }
};
