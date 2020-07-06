<fieldset>
    <legend>帳號管理</legend>
    <form action="api/admin_acc.php" method="post">
        <table style="margin:auto;width:70%">
            <tr class="ct clo">
                <td>帳號</td>
                <td>密碼</td>
                <td>刪除</td>
            </tr>
            <?php 
                $db=new DB("user");
                $rows=$db->all();
                foreach($rows as $row){
                    if($row['acc']!='admin'){
            ?>
            <tr class="ct">
                <td><?=$row['acc'];?></td>
                <td><?=str_repeat("*",strlen($row['pw']));?></td>
                <td>
                    <input type="checkbox" name="del[]" value="<?=$row['id']?>">
                </td>
            </tr>
            <?php
                    }
                }
            ?>
        </table>
        <div class="ct">
            <input type="submit" value="確定刪除">
            <input type="reset" value="清空選取">
        </div>
    </form>

    <h2>新增會員</h2>
    <form>
        <table style="" class="ct">
            <td colspan="2" style="color:red">
            *請設定您要註冊的帳號及密碼(最長12個字元)
        </td>
            <tr>
                <td width=50% class="clo">
                    Step1:登入帳號
                </td>
                <td width=50%>
                    <input width=50% type="text" name="acc" id="acc">
                </td>
            </tr>
            <tr>
                <td  class="clo">
                    Step2:登入密碼
                </td>
                <td><input type="password" name="pw" id="pw"></td>
            </tr>
            <tr>
                <td  class="clo">
                    Step3:再次確認密碼
                </td>
                <td><input type="password" name="pw2" id="pw2"></td>
            </tr>
            <tr>
                <td  class="clo">
                    Step４:信箱(忘記密碼時使用)
                </td>
                <td><input type="text" name="email" id="email"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="button" value="註冊" onclick="reg()">
                    <input type="reset" value="清除">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
<script>
function reg(){
    let acc=$("#acc").val();
    let pw=$("#pw").val();
    let pw2=$("#pw2").val();
    let email=$("#email").val();
    // 首先判斷這四個欄位是否為空白
    if(acc=="" || pw=="" || pw2=="" || email==""){
        alert("不可空白")
    }else{
        // 判斷密碼是否符合
        if(pw==pw2){
            // 去後來檢查密碼動作
            $.get("api/chk_acc.php",{acc},function(res){
                if(res==='1'){
                    alert("帳號重覆")
                }else{
                    $.post("api/reg.php",{acc,pw,email},function(res){
                        if(res==='1'){
                            alert("註冊完成，歡迎加入")
                            location.reload();
                        }else{
                            alert("註冊失敗，請聯絡管理員")
                        }
                    })
                }
            })
        }else{
            alert("密碼錯誤");
        }
    }
}
</script>