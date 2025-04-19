<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('Countries', function (Blueprint $table) {
      $table->id('CountryID');
      $table->string('CountryName', 40)->nullable();
      $table->unsignedBigInteger('RegionID');
      $table->timestamps();

      $table->foreign('RegionID')->references('RegionID')->on('Regions')->onDelete('cascade')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('Countries');
  }
};
