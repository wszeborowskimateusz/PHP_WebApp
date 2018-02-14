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
        .error {
            color: red;
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
            function getNodes(value){$.post("search_engine.php",{partialNode:value},function(data){
                $("#results").html(data);
            });
            }
    </script>


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
                        <li>
                            <a class="white" href="HTMLPage6.html">Smartphony</a>
                        </li>
                        <li>
                            <a class="white" href="HTMLPage7.html">Laptopy</a>
                        </li>
                        <li>
                            <a class="white" href="HTMLPage8.html">Konsole przenosne</a>
                        </li>
                    </ul>
                </li>
            </ol>
        </div>
        <div id="menu">
            <a href="../index.html">
                <div class="tile">Strona Glowna</div>
            </a>
            <a href="../HtmlPage2.html">
                <div class="tile">Smartphony</div>
            </a>
            <a href="../HtmlPage3.html">
                <div class="tile">Laptopy</div>
            </a>
            <a href="../HtmlPage4.html">
                <div class="tile">Konsole przenosne</div>
            </a>
            <a href="../HtmlPage5.html">
                <div class="tile">Kontakt</div>
            </a>
            <a href="index.php">
                <div class="tile">Galeria Zdjec - PHP</div>
            </a>
        </div>
        <div id="content">

            <div style="float:left;min-height:1000px;">
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

            Wpisz tytul:
           <input type="text" onkeyup="getNodes(this.value)" />
                   
            <div id="results"></div>


        </div>
        <div style="clear:both"></div>
        <div id="footer">
            Strona stworzona z mysla o projekcie.Wszelkie prawa zastrzerzone &copy;
            <a class="white" href="#container">Back to top</a>
        </div>



    </div>
</body>
</html>
