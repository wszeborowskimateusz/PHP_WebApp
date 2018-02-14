<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Urzadzenia Mobilne</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="StyleSheet.css" type="text/css" />
    <link rel="stylesheet" href="zdjecia.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" />
    <style>
        .error{
            color:red;
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>





</head>
<body>
    <div id="container">
        <div id="header">
            O urzadzeniach mobilnych slow kilka!


        </div>

        <div class="menu2">

            <ol>
                <li>
                    <a>
                        <b>Galeria zdjec</b>
                    </a>
                    <ul>
                        <li><a class="white" href="HTMLPage6.html">Smartphony</a></li>
                        <li><a class="white" href="HTMLPage7.html">Laptopy</a></li>
                        <li><a class="white" href="HTMLPage8.html">Konsole przenosne</a></li>
                    </ul>
                </li>
            </ol>
        </div>
        <div id="menu">
            <a href="../index.html"><div class="tile">Strona Glowna</div></a>
            <a href="../HtmlPage2.html"><div class="tile">Smartphony</div></a>
            <a href="../HtmlPage3.html"><div class="tile">Laptopy</div></a>
            <a href="../HtmlPage4.html"><div class="tile">Konsole przenosne</div></a>
            <a href="../HtmlPage5.html"><div class="tile">Kontakt</div></a>
            <a href="index.php"><div class="tile">Galeria Zdjec - PHP</div></a>
        </div>
        <div id="content">

            <div style="float:left;min-height:1000px;" >
                <a href="index.php">
                    <div class="tile">Przeslij plik</div>
                </a>
                <a href="zdjecia.php">
                    <div class="tile">Zdjecia</div>
                </a>
                <a href="zaloguj.php">
                    <div class="tile">Zaloguj sie</div>
                </a>
                <a href="rejestracja.php">
                    <div class="tile">Zarejestruj sie</div>
                </a>
            </div>
            
                <form method="post" action="rejestracja_ver.php">
                    E-mail:
                    <br />
                    <input type="text" name="email" value="<?php
                                                           if (isset($_SESSION['fr_email']))
                                                           {
                                                               echo $_SESSION['fr_email'];
                                                               unset($_SESSION['fr_email']);
                                                           }
                                                           ?>" />
                    <br />
                    <?php
                if (isset($_SESSION['e_email']))
                {
                    echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                    unset($_SESSION['e_email']);
                }
                    ?>
                Login:
                    <br />
                    <input type="text" name="login" value="<?php
                                                           if (isset($_SESSION['fr_login']))
                                                           {
                                                               echo $_SESSION['fr_login'];
                                                               unset($_SESSION['fr_login']);
                                                           }
                                                           ?>"/>
                    <br />

                    <?php
                if (isset($_SESSION['e_login']))
                {
                    echo '<div class="error">'.$_SESSION['e_login'].'</div>';
                    unset($_SESSION['e_login']);
                }
                    ?>
                    <br />
                    Haslo:
                    <br />
                    <input type="password" name="haslo1" value="<?php
                                                                if (isset($_SESSION['fr_haslo1']))
                                                                {
                                                                    echo $_SESSION['fr_haslo1'];
                                                                    unset($_SESSION['fr_haslo1']);
                                                                }
                                                                ?>"
                         />
                    <br />
                    <?php
                if (isset($_SESSION['e_haslo']))
                {
                    echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
                    unset($_SESSION['e_haslo']);
                }
                    ?>
                    <br />
                    Powtorz haslo:
                    <br />
                    <input type="password" name="haslo2" value="<?php
                                                                if (isset($_SESSION['fr_haslo2']))
                                                                {
                                                                    echo $_SESSION['fr_haslo2'];
                                                                    unset($_SESSION['fr_haslo2']);
                                                                }
                                                                ?>" />
                    <br />
                    <br />
                    <br />
                    <br />
                    <input type="submit" value="Zarejestruj sie" />
                    <?php
                    if (isset($_SESSION['rejestracja']))
                    {
                        echo $_SESSION['rejestracja'];
                        unset($_SESSION['rejestracja']);
                    }
                    ?>
                </form>
            



        </div>
        <div style="clear:both"></div>
        <div id="footer">
            Strona stworzona z mysla o projekcie.Wszelkie prawa zastrzerzone &copy;
            <a class="white" href="#container">Back to top</a>
        </div>
            


    </div>
</body>
</html>
