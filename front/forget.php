<fieldset style="margin:auto;padding:10px;width:50%;">

    <legend>忘記密碼</legend>
    <table style="width:100%">
        <tr>
            <td width=100%>
                <input  style="width:96%" type="text" name="email" id="email">
            </td>
        </tr>
        <tr>
            <td id="result">

            </td>
        </tr>
        <tr>
            <td>
                <input type="button" value="尋找" onclick="findPw()">
            </td>
        </tr>
    </table>
</fieldset>

<script>
function findPw(){
    // let email=document.querySelector("#email")
    let email=$("#email").val();
    if(email==""){
        alert("欄位不可為空白")
    }else{
        $.get("api/find_pw.php",{email},function(res){
            $("#result").html(res)
        })
    }
}

</script>