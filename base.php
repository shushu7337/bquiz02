<?php
date_default_timezone_set("Asia/Taipei");
session_start();


class DB{
    private $dsn="mysql:host=localhost;charset=utf8;dbname=db06";
    private $root="root";
    private $password="";
    private $table;
    private $pdo;

    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,$this->root,$this->password);
    }

    public function all(...$arg){
        $sql="select * from $this->table ";
        if(!empty($arg[0]) && is_array($arg[0])){
            foreach($arg[0] as $key => $value){
                $tmp[]=sprintf("`%s`='%s'",$key,$value);
            }
            $sql=$sql." where ". implode(" && ",$tmp);
        }
        if(!empty(arg[1])){
            $sql=$sql.$arg[1];
        }
        // echo $sql;
        return $this->pdo->query($sql)->fetchAll();
    }
    public function count(...$arg){
        $sql="select count(*) from $this->table ";
        if(isset($arg[0]) && is_array($arg[0])){
            foreach($arg[0] as $key => $value){
                $tmp[]=sprintf("`%s`='%s'",$key,$value);
            }
            $sql=$sql." where ".implode(" && ",$tmp);
        }
    }
    public function save($arg){
        if(isset($arg['id'])){
            foreach($arg as $key => $value){
                if($key!='id'){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
            }
            $sql="update $this->table set ".implode(",",$tmp)." where `id` ='".$arg['id']."'";
        }else{
            $sql="insert into $this->table (`".implode("`,`",array_keys($arg))."`) values('".implode("','",$arg)."')";
        }
        // echo $sql;
        return $this->pdo->exec($sql);
    }
    public function find($arg){
        $sql="select * from $this->table ";
        if(is_array($arg)){
            foreach($arg as $key => $value){
                $tmp[]=sprintf("`%s`='%s'",$key,$value);
            }
            $sql=$sql . " where ". implode(" && ",$tmp);
        }else{
        $sql=$sql. " where `id`='$arg'";
        }
        // echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    public function del(...$arg){
        $sql="delect from $this->table ";
        if(is_array($arg)){
            foreach($arg as $key => $value){
                $tmp[]=sprintf("`%s`='%s'",$key,$value);
            }
            $sql=$sql." where ".implode(" && ",$tmp);
        }else{
            $sql=$sql." where `id`='$arg'";
            // echo $sql;
        }
    }
    public function q($sql){
        return $this->pdo->query($sql)->fetchAll();
    }

}
function to($url){
    header("location:".$url);
}

// 判斷瀏覽人次
$total=new DB('total');
// 先來判斷是否有今天的資料
$chk=$total->find(['date' => date("Y-m-d")]);
if(empty($chk) && empty($_SESSION['visited'])){     //沒有日期資料且沒有session存在(~今天頭香~需要新增今日資料)
    $total->save(["date"=>date("Y-m-d"),"total"=>1]);
    $_SESSION['visited']=1;
}else if(empty($chk) && (!empty($_SESSION['visited']))){    //沒有日期資料,但有session(直接改日期瀏覽器沒有關閉，或是電腦沒關直接放到隔天)(異常情形：補上今日資料)
    $total->save(["date"=>date("Y-m-d"),"total"=>1]);     //此狀況已經有_SESSION了 故不用再給他一次

}else if(!empty($chk) && empty($_SESSION['visited'])){     //session為空 但卻有session (表示新來的，需要加一)
    $chk['total']++;
    $total->save($chk);
    $_SESSION['visited']=1;

}/*else{      //有今天的日期資料，也有session值

}*/
// if(empty($_SESSION['visited'])){
//     // 確認是否有今天的資料存在
//     // // 如果不存在會回復空陣列
//     // print_r ("結果",$chk);
//     if(empty($chk)){
//         // 沒有今天的資料
//         $total->save(['date'=>date("Y-m-d"),'total'=>1]);
//     }else{
//         // 有今天的資料
//         $chk['total']++;
//         $total->save($chk);
//     }
//     // 判斷並建立一個session
//     $_SESSION['visited']=1;
// }

?>