<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {
  protected $primaryKey = 'DepartmentID';
  protected $fillable = [
    'DepartmentName',
    'ManagerID',
    'LocationID',
  ];

  public function Location() {
    return $this->belongsTo(Location::class, 'LocationID', 'DepartmentID');
  }

  public function Employees() {
    return $this->hasMany(Employee::class, 'EmployeeID', 'DepartmentID');
  }
}
