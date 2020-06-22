<?php
include_once "../base.php";

$db=new DB("user");
$acc=$_GET['acc'];

$chk=$db->find(['acc'=>$acc]);
//透過$chk是否為空值來判斷帳號是否存在
if(empty($chk)){
    echo 0;
}else{
    echo 1;
}
?>