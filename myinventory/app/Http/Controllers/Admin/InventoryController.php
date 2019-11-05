<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//以下を追記し、Inventory Modelを使える状態にする
use App\Inventory;

use Carbon\Carbon;

use Storage;

class InventoryController extends Controller
{
  
  public function add()
  {
    return view('admin.inventory.create');
  }
    
  public function create(Request $request)
  {
    
    //validationを行う
    $this->validate($request, Inventory::$rules);
    
    $inventory = new Inventory;
    $form = $request->all();
    
    //フォームから送信されてきた_tokenを削除する
    unset($form['_token']);
    
    //データベースに保存する
    $inventory->fill($form);
    $inventory->save();
    
    // admin/inventoryにリダイレクト
    return redirect('admin/inventory');
  }
  
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
  
   return view('admin.inventory.index', ['inventories' => $inventories, 'cond_title' => $cond_title, 'now' =>$now]);
  }
  
  public function edit (Request $request)
  {
    //Inventory Modelからデータを取得する
    $inventory = Inventory::find($request->id);
    if (empty($inventory)) {
      abort(404);
    }
    return view('admin.inventory.edit',['inventory_form' => $inventory]);
  }
  
  public function update(Request $request)
  {
    //validationをかける
    $this->validate($request, Inventory::$rules);
    //Inventory Modelからデータを取得
    $inventory = Inventory::find($request->id);
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