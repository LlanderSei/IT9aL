<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::table('Jobs', function (Blueprint $table) {
      $table->renameColumn('id', 'JobID');
      $table->dropColumn('queue');
      $table->dropColumn('payload');
      $table->dropColumn('attempts');
      $table->dropColumn('reserved_at');

      $table->string('JobTitle', 35);
      $table->decimal('MinSalary', 10, 2)->nullable();
      $table->decimal('MaxSalary', 10, 2)->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::table('Jobs', function (Blueprint $table) {
      $table->dropColumn('JobTitle');
      $table->dropColumn('MinSalary');
      $table->dropColumn('MaxSalary');

      $table->renameColumn('JobID', 'id');
      $table->string('queue')->after('id');
      $table->longText('payload')->after('queue');
      $table->unsignedTinyInteger('attempts')->after('payload');
      $table->unsignedInteger('reserved_at')->nullable()->after('attempts');
    });
  }
};
