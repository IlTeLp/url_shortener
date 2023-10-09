<?php
$db = mysqli_connect('localhost', 'root', '', 'short') or die('error');
if (isset($_GET['id'])){
    $del_id=mysqli_real_escape_string($db, $_GET['id']);
    $sql=mysqli_query($db,"DELETE FROM `test` WHERE `short_key`='$del_id'");
    if($sql){
        header("Location: urlshorter.php");
    }
    else{
        header("Location: urlshorter.php");
    }
}
else{
    header("Location: urlshorter.php");
}
