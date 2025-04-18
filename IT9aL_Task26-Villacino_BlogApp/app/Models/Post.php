<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
  protected $primaryKey = 'PostID';
  protected $fillable = ['Title', 'Body'];
  public $timestamps = true;
}
