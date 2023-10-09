<?php
$baza=mysqli_connect('localhost','root','','second');
if(!$baza){
    echo "CONNECTION LOST";
}
$name=$_POST['user'];
$password=md5($_POST['pass']);
$chek=mysqli_query($baza,"SELECT * FROM `users` where `login` = '$name' AND `password_hash` = '$password'");
if(mysqli_num_rows($chek)>0){
    header('Location: urlshorter.php');
}
else{
    echo "Ошибка входа!";
}