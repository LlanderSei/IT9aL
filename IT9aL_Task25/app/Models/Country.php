<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {
  protected $primaryKey = 'CountryID';
  protected $fillable = [
    'CountryID',
    'CountryName',
    'RegionID',
  ];

  public function Region() {
    return $this->belongsTo(Region::class, 'RegionID', 'CountryID');
  }

  public function Locations() {
    return $this->hasMany(Location::class, 'LocationID', 'CountryID');
  }
}
