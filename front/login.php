<fieldset style="margin:auto;padding:10px;width:50%;">

    <legend>會員登入</legend>
    <table>
        <tr>
            <td width=50% class="clo">帳號</td>
            <td width=50%>
                <input width=50% type="text" name="acc" id="acc">
            </td>
        </tr>
        <tr>
            <td  class="clo">密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td>
                <input type="button" value="登入" onclick="login()">
                <input type="reset" value="清除">
            </td>
            <td>
                <a href="?do=forget">忘記密碼</a> |
                <a href="reg">尚未註冊</a>
            </td>
        </tr>
    </table>
</fieldset>

<script>
function login(){
    // let acc=document.querySelector("#acc")
    let acc=$("#acc").val();
    let pw=$("#pw").val();
    if(acc=="" || pw==""){
        alert("帳號及密碼欄位不可為空白")
    }else{
        //由於這裡使用的ajax是使用背景傳輸，故這裡使用get
        $.get("api/chk_acc.php",{acc},function(res){
            if(res==='1'){      //有此帳號
                $.get("api/chk_pw.php",{acc,pw},function(res){   //acc 與 pw 都要一起送才會知道是誰的帳號及誰的密碼 
                    if(res==='1'){
                        location.href="index.php";  //回到首頁
                    }else{
                        alert("密碼錯誤");
                        location.reload();
                    }
                })           
           }else{       //沒有這個帳號
                alert("查無帳號");
                location.reload();      //直接做重置(reload這個頁面)
            }
        })
    }
}

</script>