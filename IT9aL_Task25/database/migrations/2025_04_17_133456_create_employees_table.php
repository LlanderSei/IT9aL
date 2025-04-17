<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('Employees', function (Blueprint $table) {
      $table->id('EmployeeID');
      $table->string('FirstName', 20);
      $table->string('LastName', 20);
      $table->string('Email', 100)->unique();
      $table->string('PhoneNumber', 20)->nullable();
      $table->date('HireDate')->nullable();
      $table->unsignedBigInteger('JobID')->nullable();
      $table->decimal('Salary', 8, 2);
      $table->unsignedBigInteger('ManagerID')->nullable();
      $table->unsignedBigInteger('DepartmentID')->nullable();
      $table->timestamps();

      $table->foreign('JobID')->references('JobID')->on('Jobs')->onDelete('cascade')->onUpdate('cascade');
      $table->foreign('ManagerID')->references('EmployeeID')->on('Employees')->onDelete('cascade')->onUpdate('cascade');
      $table->foreign('DepartmentID')->references('DepartmentID')->on('Departments')->onDelete('cascade')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('Employees');
  }
};
