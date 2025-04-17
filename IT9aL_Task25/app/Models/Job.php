<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {
  protected $primaryKey = 'JobID';
  protected $fillable = [
    'JobTitle',
    'MinSalary',
    'MaxSalary',
  ];

  public function Jobs() {
    return $this->hasMany(Employee::class, 'EmployeeID', 'JobID');
  }
}
