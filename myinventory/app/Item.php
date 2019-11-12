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
  public function inventory()
    {
      return $this->hasOne('App\Inventory');
    }
  
}
