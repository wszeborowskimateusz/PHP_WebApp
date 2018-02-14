<?php
session_start();

$radio="";
if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']===true))
{
    $radio .= 'Dostep: <br/>Prywatne:<input type=radio name="access" value="prywatne"/><br/>Publiczne:<input type=radio name="access" value="publiczne"/><br/>';
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Urządzenia Mobilne</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="StyleSheet.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    


</head>
<body >
    <div id="container">
        <div id="header">
            O urządzeniach mobilnych słów kilka!


        </div>

        <div class="menu2">

            <ol>
                <li>
                    <a><b>Galeria zdjęć</b></a>
                    <ul>
                        <li><a class="white" href="HTMLPage6.html">Smartphony</a></li>
                        <li><a class="white" href="HTMLPage7.html">Laptopy</a></li>
                        <li><a class="white" href="HTMLPage8.html">Konsole przenośne</a></li>
                    </ul>
                </li>
            </ol>
        </div>
        <div id="menu">
            <a href="../index.html"><div class="tile">Strona Główna</div></a>
            <a href="../HtmlPage2.html"><div class="tile">Smartphony</div></a>
            <a href="../HtmlPage3.html"><div class="tile">Laptopy</div></a>
            <a href="../HtmlPage4.html"><div class="tile">Konsole przenośne</div></a>
            <a href="../HtmlPage5.html"><div class="tile">Kontakt</div></a>
            <a href="index.php"><div class="tile">Galeria Zdjęć - PHP</div></a>
        </div>
        <div id="content">

                <div style="float:left;min-height:900px;">
                    <a href="index.php"><div class="tile">Prześlij plik</div></a>
                    <a href="zdjecia.php"><div class="tile">Zdjecia</div></a>
                    <a href="zaloguj.php"><div class="tile">Zaloguj się</div></a>
                    <a href="rejestracja.php"><div class="tile">Zarejestruj się</div></a>
                    
                </div> 

           <form method="post" enctype="multipart/form-data" action="kontrola.php">
               <input type="file" name="zdjecie" />
			   <br/>
               Znak wodny:<br/><input type="text" name="znak_wodny"/>
               <br/>
               Autor:<br/> <input type="text" name="autor" <?php if(isset($_SESSION['user'])) echo'value="'.$_SESSION['user'].'"'; ?>/>
               <br />
               Tytul: <br/><input type="text" name="tytul" />
               <br /><br/>
               <input type="submit" value="Wyślij" />
               <br/>
               <?php
               echo $radio;

               echo '<br/>';

               if(isset($_SESSION['blad_typu']))
               {
                   echo '<span style="color:red;">'.$_SESSION['blad_typu'].'</span>';
                   unset($_SESSION['blad_typu']);
               }

               echo "</br>";

               if(isset($_SESSION['blad_rozmiaru']))
               {
                   echo '<span style="color:red;">'.$_SESSION['blad_rozmiaru'].'</span>';
                   unset($_SESSION['blad_rozmiaru']);
               }

               echo "</br>";

               if(isset($_SESSION['pomyslny_upload']))
               {
                   echo '<span style="color:darkgreen;">'.$_SESSION['pomyslny_upload'].'</span>';
                   unset($_SESSION['pomyslny_upload']);
               }

               echo "</br>";

               if(isset($_SESSION['blad_znak']))
               {
                   echo '<span style="color:red;">'.$_SESSION['blad_znak'].'</span>';
                   unset($_SESSION['blad_znak']);
               }

               echo "</br>";

               if(isset($_SESSION['blad_autor']))
               {
                   echo '<span style="color:red;">'.$_SESSION['blad_autor'].'</span>';
                   unset($_SESSION['blad_autor']);
               }

               echo "</br>";

               if(isset($_SESSION['blad_tytul']))
               {
                   echo '<span style="color:red;">'.$_SESSION['blad_tytul'].'</span>';
                   unset($_SESSION['blad_tytul']);
               }

               echo "</br>";

               if(isset($_SESSION['blad_dostep']))
               {
                   echo '<span style="color:red;">'.$_SESSION['blad_dostep'].'</span>';
                   unset($_SESSION['blad_dostep']);
               }

               ?>


		   </form>


        </div>
        <div style="clear:both"></div>
        <div id="footer">Strona stworzona z myślą o projekcie.Wszelkie prawa zastrzeżone &copy;<a class="white" href="#container">  Back to top</a></div>



    </div>
</body>
</html>
