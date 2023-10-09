<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="main.php">Главная</a> | <a href="registration.php">Регистрация</a> | <a href="log.php">Вход</a>
<br>
<?php
$db = mysqli_connect('localhost', 'root', '', 'short') or die('error');

$link = htmlspecialchars($_POST['link']);
if(empty($_POST['submit'])){}
if(empty($_POST['link'])){}
else {
    $select = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `test` WHERE `url` =  '$link' "));
    if($select){
        $result1 = [
            'url'  => $select['url'],
            'key'  => $select['short_key'],
            'link' => 'http://localhost:63342/second/urlshorter.php?key='.$select['short_key']
        ];
    }
    else{
        $unique = uniqid('', true);
        $result = substr($unique, strlen($unique) - 4);
        mysqli_query($db,"INSERT INTO `test` (`id`, `url`, `short_key`) VALUES (NULL, '$link', '$result')");
        $select1=mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `test` WHERE `url` =  '$link' "));
        $result = [
            'url'  => $select1['url'],
            'key'  => $select1['short_key'],
            'link' => "http://localhost:63342/second/urlshorter.php?key=".$select1['short_key']
        ];
    }
}
$key = htmlspecialchars($_GET['key']);
if (empty($_GET['key'])){
}
else{
    $select1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `test` WHERE `short_key` =  '$key'"));
    if($select1){
        $result2=[
            'url' => $select1['url'],
            'key' => $select1['short_key']
        ];
        header('Location:'.$result2['url']);
    }
}
?>
<br>
<form action="" method="post">
    <input type="text" name="link">
    <input type="submit" name="submit">
</form>
<br>
<?php
$sql=mysqli_query($db,"SELECT * FROM `test` ORDER BY `id` DESC");
if(mysqli_num_rows($sql)>0){
    while($res=mysqli_fetch_assoc($sql)){
        ?>
        <li><a href="http://localhost:63342/second/urlshorter.php?key=<?php echo $res['short_key']; ?>">
               <?php echo "http://localhost:63342/second/urlshorter.php?key=".$res['short_key'];?>
        </a></li>
        <li><a href="delete.php?id=<?php echo $res['short_key'];?>">Delete</a></li>
    <?php
    }
}
?>
</body>
</html>