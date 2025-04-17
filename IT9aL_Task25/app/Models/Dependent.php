<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dependent extends Model {
  protected $primaryKey = 'DependentID';
  protected $fillable = [
    'FirstName',
    'LastName',
    'Relationship',
    'EmployeeID',
  ];

  public function Employee() {
    return $this->belongsTo(Employee::class, 'DependentID', 'EmployeeID');
  }
}
