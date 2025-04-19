<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('Dependents', function (Blueprint $table) {
      $table->id('DependentID');
      $table->string('FirstName', 50);
      $table->string('LastName', 50);
      $table->string('Relationship', 50);
      $table->unsignedBigInteger('EmployeeID');
      $table->timestamps();

      $table->foreign('EmployeeID')->references('EmployeeID')->on('Employees')->onDelete('cascade')->onUpdate('cascade');
    });
  }
  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('Dependents');
  }
};
