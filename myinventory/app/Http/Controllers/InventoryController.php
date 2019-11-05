<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\Inventory;
use Carbon\Carbon;

class InventoryController extends Controller
{
  public function index(Request $request)
  {
   $cond_title = $request->cond_title;
   if ($cond_title !=''){
     //検索されたら検索結果を取得する
     $inventories = Inventory::where('title', $cond_title)->get();
   } else {
     //それ以外はすべての在庫名を取得する
     $inventories = Inventory::all();
   }
  
   $now = Carbon::now();
   
     //inventory/index.blade.php ファイルに渡している
    return view('inventory.index', ['inventories' => $inventories ,'cond_title' => $cond_title ,'now' =>$now]);
  }
  
}





