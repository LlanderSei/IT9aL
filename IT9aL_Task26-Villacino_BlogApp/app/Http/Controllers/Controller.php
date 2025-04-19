<?php

namespace App\Http\Controllers;

abstract class Controller {
  public function BlogIndex() {
    return view('blogs.index');
  }
}
