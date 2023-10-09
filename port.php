<?php
$baza=mysqli_connect('localhost','root','','second');
if(!$baza){
    echo "CONNECTION LOST";
}
$name=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];
if($name==""){
    echo "Введите имя!";
}
else if($email==""){
    echo "Введите почту!";
}
else if($password==""){
    echo "Введите пароль!";
}
else{
    $password=md5($_POST['password']);
    mysqli_query($baza,"INSERT INTO `users` (`id`, `login`, `mail`, `password_hash`) VALUES (NULL, '$name','$email', '$password')");
    header('Location: urlshorter.php');
}
