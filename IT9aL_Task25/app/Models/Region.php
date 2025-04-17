<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {
  protected $primaryKey = 'RegionID';
  protected $fillable = [
    'RegionName',
  ];

  public function Countries() {
    return $this->hasMany(Country::class, 'CountryID', 'RegionID');
  }
}
