<?php
include_once "../base.php";
$db=new DB("user");
// $acc=$_POST['acc'];
// $pw=$_POST['pw'];
// $email=$_POST['email'];

// 寫入上列欄位
// echo $db->save(['acc'=>$acc,'pw'=>$pw,'email'=>$email]);
echo $db->save($_POST);
?>