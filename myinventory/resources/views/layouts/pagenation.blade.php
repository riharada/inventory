<?php
define('MAX','3'); // 1ページの記事の表示数
 
$inventory = 「入れる」
            
$inventory_num = count($inventory->id); // トータルデータ件数
 
$max_page = ceil($inventory_num / MAX); // トータルページ数※ceilは小数点を切り捨てる関数
 
if(!isset($_GET['page_id'])){ // $_GET['page_id'] はURLに渡された現在のページ数
    $now = 1; // 設定されてない場合は1ページ目にする
}else{
    $now = $_GET['page_id'];
}
 
$start_no = ($now - 1) * MAX; // 配列の何番目から取得すればよいか
 
// array_sliceは、配列の何番目($start_no)から何番目(MAX)まで切り取る関数
$disp_data = array_slice($inventory, $start_no, MAX, true);
 
foreach($disp_data as $val){ // データ表示
    echo $val[' 入れる  ']. '　'.$val[' 入れる　']. '<br />';
}
 
for($i = 1; $i <= $max_page; $i++){ // 最大ページ数分リンクを作成
    if ($i == $now) { // 現在表示中のページ数の場合はリンクを貼らない
        echo $now. '　'; 
    } else {
        echo '<a href=\'/pagenation.blade.php?page_id='. $i. '\')>'. $i. '</a>'. '　';
    }
}
 
?>

//ページネーション、むり。。。やり方、繋げ方がさっぱりわからないー＞＜
//lampager とやらを使う？