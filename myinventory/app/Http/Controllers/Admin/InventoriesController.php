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
     $item = Item::where('name', $cond_title);
     //検索されたら検索結果を取得する
     $inventories = Inventory::select()->join('items','inventories.item_id','=','items.id')->where('items.name','=',$cond_title)->orderBy('date','desc')->get()->unique('item_id');
   } else {
     //それ以外はすべての在庫名を取得する
     $inventories = Inventory::orderBy('date','desc')->get()->unique('item_id');
   }
   
   //各商品の消費期間の平均を算出する
    $items =Item::all();
   
   
   
    $now = Carbon::now();
   
    
   
   
    //ページネーション
    $pages = Inventory::paginate(3);
    
    return view('admin.inventory.index', ['inventories' => $inventories, 'cond_title' => $cond_title, 'now'=>$now, 'items' =>$items, 'pages'=>$pages]);
  }
  
  public function edit (Request $request)
  {
    //Inventory Modelからデータを取得する
    $inventory = Inventory::find($request->id);
    if (empty($inventory)) {
      abort(404);
    }
    
    $inventories = Inventory::orderBy('date','desc')->get();
    
    return view('admin.inventory.edit', ['inventory'=>$inventory, 'inventories'=>$inventories]);
  }
  
  public function update(Request $request)
  {
    //validationをかける
    $this->validate($request, Inventory::$rules);
    //Inventory Modelからデータを取得
    $inventory = Inventory::find($request->item_id);
    //送信されてきたフォームデータを格納
    $inventory_form = $request->all();
    
    unset($inventory_form['_token']);
    $inventory->fill($inventory_form)->save();
    
    
    return redirect('admin/inventory');
  }
  
  public function delete(Request $request)
  {
    //該当するInventory Modelを取得
    $inventory = Inventory::find($request->id);
    
    $inventory->delete();
    return redirect('admin/inventory');
  }
  
}