<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;

class Inventory extends Model
{
  protected $guarded = array('id');

  public static $rules = array(
    'item_id' => 'required',
    'date' => 'required',
  );

  protected $dates =[
    'date'
    ];
  
  public function item()
    {
      return $this->belongsTo('App\Item');
    }
}