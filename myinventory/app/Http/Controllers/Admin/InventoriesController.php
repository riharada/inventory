<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Inventory;
use App\Item;

use Carbon\Carbon;

use Storage;

class InventoriesController extends Controller
{
  
  public function add()
  {
    $items = Item::all();
    
    return view('admin.inventory.create', ['items'=>$items]);
  }
    
  public function create(Request $request)
  {
    //validationを行う
    $this->validate($request, Inventory::$rules);
    
    $inventory = new Inventory;
    
    //商品を新規登録ならitemに追加
    $item_id = $request->item_id;
    $date = $request->date;
    if($item_id != 0) {
      $inventory->item_id = $item_id;
      $inventory->date = $date;
      $inventory->save();
    } elseif(isset($request->input_item)) {
      $item = new Item;
      $item->name =  $request->input_item;
      $item->save();
      $inventory->item_id = $item->id;
      $inventory->date = $date;
      $inventory->save();
    } else {
      abort(404);
    }
    
    // admin/inventoryにリダイレクト
    return redirect('admin/inventory');
  }
  
  public function index(Request $request)
  {
    $cond_title = $request->cond_title;
   if ($cond_title !=''){
     $items = Item::where('name', $cond_title)->get();
   } else {
     //それ以外はすべての在庫名を取得する
     $items = Item::all();
   }
   
   //各商品の消費期間の平均を算出する
   $now = Carbon::now();
   //2次元（多次元）の連想配列の$array(keyがitem_id、valueが消費日数、あと～日)
   //item->inventories->count で回数
   $array_inventories = array();
   
   foreach($items as $item) {
     $total_days = $item->inventories->min('date')->diffInDays($item->inventories->max('date'));
     $count_days = $item->inventories->count('date');
     if($count_days-1 == 0) {
       $avr_days = 0;
      } else {
        $avr_days = floor($total_days / ($count_days-1));
      }
     
     $next_days = $item->inventories->max('date')->addDays($avr_days);
     $rem_days = $now->diffInDays($next_days);
     $array = array('avr'=>$avr_days, 'rem'=>$rem_days);
     $array_inventories[] = array('item'=>$item, 'next'=>$next_days, 'avr'=>$avr_days, 'rem'=>$rem_days);
   }
   
   //ページネーション
   
 
    return view('admin.inventory.index', ['cond_title'=>$cond_title,'array_inventories'=>$array_inventories]);
  }
  
  public function edit (Request $request)
  {
    //Item Modelからデータを取得する
    $item = Item::find($request->id);
    if (empty($item)) {
      abort(404);
    }
   
       return view('admin.inventory.edit', ['item'=>$item]);
  }  
    
  public function update (Request $request)
  {
    //validationを行う
    $this->validate($request, Inventory::$rules);
    
    $inventory = new Inventory;
    
    $item_id = $request->item_id;
    $date = $request->date;
    if($date != 0) {
      $inventory->item_id = $item_id;
      $inventory->date = $date;
      $inventory->save();
    } else {
      abort(404);
    }
  
    return redirect('admin/inventory');
  }
  
  public function delete(Request $request)
  {
    $inventory = Inventory::find($request->id);
    $item_id = $inventory->item_id;
    $inventory->delete();
    $item = Item::find($item_id);
    
    //Inventoryのid（購入履歴）を削除する場合の処理 →Inventoryのidが全てなくなったら、紐づくItemのidを削除する
    if($item->inventories == NULL)
      $item->delete();
    
    return redirect('admin/inventory');
  }
  
}