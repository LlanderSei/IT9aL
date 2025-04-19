<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('Locations', function (Blueprint $table) {
      $table->id('LocationID');
      $table->string('StreetAddress', 40)->nullable();
      $table->string('PostalCode', 12)->nullable();
      $table->string('City', 30);
      $table->string('StateProvince',25)->nullable();
      $table->unsignedBigInteger('CountryID');
      $table->timestamps();

      $table->foreign('CountryID')->references('CountryID')->on('Countries')->onDelete('cascade')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('Locations');
  }
};
