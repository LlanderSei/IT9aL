<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {
  protected $primaryKey = "TaskID";
  protected $fillable = ["Title", "Description", "IsCompleted"];
  public $timestamps = true;
}
