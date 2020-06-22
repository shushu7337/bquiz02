<?php
include_once "../base.php";

$db=new DB("user");
$acc=$_GET['acc'];
$pw=$_GET['pw'];
// 多一個判斷pw的值
$chk=$db->find(['acc'=>$acc,'pw'=>$pw]);
//透過$chk是否為空值來判斷帳號是否存在
if(empty($chk)){
    echo 0;
}else{
    echo 1;
    // 如果是登入成功的狀態建立一個session
    $_SESSION['login']=$acc;
}
?>