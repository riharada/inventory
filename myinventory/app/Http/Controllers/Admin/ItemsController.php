<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Item;

class ItemsController extends Controller
{
  public function delete(Request $request)
  {
     $item = Item::find($request->id);
     $item->delete();
    
    return redirect('admin/inventory');
  }
}
