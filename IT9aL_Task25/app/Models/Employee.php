<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {
  protected $primaryKey = 'EmployeeID';
  protected $fillable = [
    'FirstName',
    'LastName',
    'Email',
    'PhoneNumber',
    'HireDate',
    'JobID',
    'Salary',
    'CommissionPct',
    'ManagerID',
    'DepartmentID',
  ];

  public function Department() {
    return $this->belongsTo(Department::class, 'DepartmentID', 'EmployeeID');
  }

  public function Job() {
    return $this->belongsTo(Job::class, 'JobID', 'EmployeeID');
  }

  public function Manager() {
    return $this->belongsTo(Employee::class, 'ManagerID', 'EmployeeID');
  }

  public function Employees() {
    return $this->hasMany(Employee::class, 'EmployeeID', 'ManagerID');
  }

  public function Dependents() {
    return $this->hasMany(Dependent::class, 'DependentID', 'EmployeeID');
  }
}
