<?php
include_once "../base.php";

$email=$_GET['email'];
$db=new DB('user');
$user=$db->find(['email' => $email]);

// 如果$user為空值 則 echo "查無此帳號"  ，如果有此user 則 echo "您的密碼為:".$user['pw']
if(empty($user)){
    echo "查無此帳號";
}else{
    echo "您的密碼為:".$user['pw'];
}

?>