<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
  protected $guarded = array('id');

  public static $rules = array(
    'title' => 'required',
    'number' => 'required',
    'duration' => 'required',
  );
}