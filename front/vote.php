
<style>
.bar{
    background: #ccc;
    height: 20px;
    display: inline-block;
}

</style>
<?php
    $q=$_GET['q'];
    $db=new DB('que');
    $subject=$db->find($q);
    $options=$db->all(['parent'=>$q]);

?>

<fieldset>
    <legend>目前位置：首頁 > 問卷調查 > <?=$subject['text'];?></legend>
    <h3><?=$subject['text'];?></h3>
    <form action="api/vote.php" method="post">
        <table>
        <?php
    
            foreach($options as $key => $row){
        ?>
            <tr>
                <td ><input type="radio" name="vote" value="<?=$row['id'];?>"><?=$row['text'];?></td>
            </tr>
            <?php
            }
            ?>
        </table>
    <div class="ct"><input type="submit" value="我要投票"></div>
    </form>
</fieldset>