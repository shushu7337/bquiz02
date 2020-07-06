<?php
include_once "../base.php";

$db=new DB("news");

foreach($_POST['id'] as $key => $id){
    if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
        $db->del($id);
    }else{
        $row=$db->find($id);
        // 如果$row['sh'] 有在in_array($id,$_POST['sh']) 的話 顯示1 沒有的話顯示0
        $row['sh']=(!empty($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
        $db->save($row);
    }
}
to("../admin.php?do=news");


?>