<?php
session_start();
//Weryfikacja danych przesy³anych przy rejestracji

if(isset($_POST['email']))
{
    $fine = true;

    //poprawnosc loginu
    $login = $_POST['login'];
    if (ctype_alnum($login)==false)
    {
        $fine=false;
        $_SESSION['e_login']="Nick moze sk³adac siê tylko z liter i cyfr (bez polskich znakow)";
    }

    //poprawnosc emaila
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
    {
        $fine=false;
        $_SESSION['e_email']="Podaj poprawny adres e-mail!";
    }

    //poprawnosc hasla
    $haslo1 = $_POST['haslo1'];
    $haslo2 = $_POST['haslo2'];
    if ($haslo1!=$haslo2)
    {
        $fine=false;
        $_SESSION['e_haslo']="Podane hasla nie sa identyczne!";
    }

    if((strlen($haslo1)<=0)||(strlen($haslo2)<=0))
    {
        $fine=false;
        $_SESSION['e_haslo']="Wprowadz haslo";
    }

    $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);

    $_SESSION['fr_login'] = $login;
    $_SESSION['fr_email'] = $email;
    $_SESSION['fr_haslo1'] = $haslo1;
    $_SESSION['fr_haslo2'] = $haslo2;




    //Baza danych
    require_once("connect.php");
    $db = get_db();
    $query_email=['email'=>$email];
    $query_login=['login'=>$login];
    $ile_maili = $db->users->count($query_email);
    $ile_loginow = $db->users->count($query_login);
    if($ile_maili>0)
    {
        $fine = false;
        $_SESSION['e_email']="Podany email jest zajety";
    }

    if($ile_loginow>0)
    {
        $fine = false;
        $_SESSION['e_login']="Podany login jest zajety";
    }
    
        if($fine==true){
            $db->users->insert([
                'email'=>$email,
                'login' => $login,
                'password' => $haslo_hash,
                ]);
            $_SESSION['rejestracja']= "Udana rejestracja";
        }

    

    header("Location: rejestracja.php");
}
else
{
    $_SESSION['e_login']="Podaj email";
}


?>