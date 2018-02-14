<?php
session_start();

$login = $_POST['login'];
$haslo = $_POST['haslo'];

require_once("connect.php");

$db = get_db();

$user = $db->users->findOne(['login' => $login]);

if($user !== null && password_verify($haslo, $user['password'])){
    $_SESSION['user_id'] = $user['_id'];
    $_SESSION ['logowanie']="Udalo sie zalogowac";
    $_SESSION ['zalogowany']=true;
    $_SESSION ['user'] = $login;
    header("Location:zalogowany.php");
}
else
{
    $_SESSION['e_logowanie']="Niewlasciwy login lub haslo";
    header("Location:zaloguj.php");
}


?>