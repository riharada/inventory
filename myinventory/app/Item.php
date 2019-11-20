<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Inventory;

class Item extends Model
{
  protected $guarded = array('id');

  public static $rules = array(
    'name' => 'required',
  );
  public function inventories()
  {
    return $this->hasMany('App\Inventory');
  }
  
}
