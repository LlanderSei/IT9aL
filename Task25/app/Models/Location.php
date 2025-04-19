<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {
  protected $primaryKey = 'LocationID';
  protected $fillable = [
    'StreetAddress',
    'PostalCode',
    'City',
    'StateProvince',
    'CountryID',
  ];

  public function Country() {
    return $this->belongsTo(Country::class, 'CountryID', 'LocationID');
  }

  public function Departments() {
    return $this->hasMany(Department::class, 'DepartmentID', 'LocationID');
  }
}
